<?php

namespace App\Service;


use App\Constants;
use App\Events\PostNotification;
use App\Models\Clients;
use App\Models\Discount;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use App\Models\SalesItems;
use App\Models\SalesPayments;
use App\Models\SalesReports;
use App\Models\ServicePrice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SalesService
{
    public $clienService;
    public $productsService;

    public function __construct(ClientService $clientService, ProductsService $productsService)
    {
        $this->clienService = $clientService;
        $this->productsService = $productsService;
    }

    public function salesItemsSave($sales, $client_dicount_price, $client_id, $order_data, $paid_amount, $return_amount, $card_sum, $cash_sum, $text, $checklist_changed, $debt_sum){
        $lang = App::getLocale();
        $sales->client_id = $client_id;
        if($text == 'checklist'){
            $sales->status = Constants::CHECKLIST;
        }else{
            $sales->status = Constants::NOT_CHECKLIST;
        }
        $sales->save();
        $all_price = 0;
        $all_cost_price = 0;
        $order_discount_price = 0;
        foreach($order_data as $orderData){
            $order_data_price = (int)str_replace(' ', '', $orderData['price']);
            $order_data_discount = (int)str_replace(' ', '', $orderData['discount']);
            $all_price = $all_price + (float)$orderData['quantity'] * $order_data_price;
            $order_discount_price = $order_discount_price + (float)$orderData['quantity'] * $order_data_discount;
            $sales_old_items = $sales->salesItems;
            $salesPayment = $sales->salesPayment;
            $salesReport = $sales->salesReport;
            foreach($sales_old_items as $sales_old_item){
                $sales_old_item->delete();
            }
            if($salesPayment){
                $salesPayment->delete();
            }
            if($salesReport){
                $salesReport->delete();
            }
            $sales_items = new SalesItems();
            $product = Products::find($orderData['id']);
            if($product){
                $sales_items->sale_id = $sales->id;
                $sales_items->product_id = $orderData['id'];
                $sales_items->quantity = (float)$orderData['quantity'];
                $sales_items->discount_price = $order_data_discount;
                $sales_items->discount_percent = $orderData['discount_percent'];
                $sales_items->cost_price = $product->cost;
                $all_cost_price = $all_cost_price + $product->cost * (float)$orderData['quantity'];
                $sales_items->price = $order_data_price;
                $sales_items->save();
                $product->stock = $product->stock - (float)$orderData['quantity'];

                if((float)$product->stock<=5){
                    $message = $product->name.' '. $product->amount.' '.translate_title('has left ', $lang). ' '.$product->stock;
                    event(new PostNotification($message));
                }
                $product->save();
            }
        }
        $discount_modal_percent = 0;
        if($sales->client_id){
            $discount_modal = Discount::where('client_id', $sales->client_id)->first();
            if($discount_modal){
                $discount_modal_percent = (int)$discount_modal->percent/100;
            }
        }
        if($discount_modal_percent == 0){
            $client_dicount_price = 0;
        }
        $sales->price = $all_price;
        $sales->discount = $order_discount_price;
        $sales->client_discount_price = (int)$client_dicount_price;
        $total_price = $all_price - $order_discount_price - (int)$client_dicount_price;
        $sales->paid_amount = $paid_amount;
        $sales->return_amount = $return_amount;
        $sales->total_amount = $total_price;
        $sales->debt_amount = $debt_sum;
        $sales->save();
        if((int)$card_sum > 0){
            $sales_payments = new SalesPayments();
            $sales_payments->sale_id = $sales->id;
            $sales_payments->payment_method = Constants::CARD;
            $sales_payments->amount = $card_sum;
            $sales_payments->save();
        }
        if((int)$cash_sum > 0){
            $sales_payments = new SalesPayments();
            $sales_payments->sale_id = $sales->id;
            $sales_payments->payment_method = Constants::CASH;
            $sales_payments->amount = $cash_sum;
            $sales_payments->save();
        }
        if($all_cost_price>0){
            $sales_reports = new SalesReports();
            $sales_reports->sale_id = $sales->id;
            $sales_reports->report_date = date('Y-m-d H:i:s');
            $sales_reports->revenue = $all_price;
            $sales_reports->profit = $all_price - $all_cost_price;
            $sales_reports->save();
        }
        $sales_id = (string)$sales->id;
        if(strlen($sales_id)<8){
            $length = 8;
        }elseif(strlen($sales_id)>=8 && strlen($sales_id)<10){
            $length = 10;
        }elseif(strlen($sales_id)>=10 && strlen($sales_id)<12){
            $length = 12;
        }elseif(strlen($sales_id)>=12 && strlen($sales_id)<14){
            $length = 14;
        }elseif(strlen($sales_id)>=14 && strlen($sales_id)<=16){
            $length = 16;
        }
        $sales_code = (string)str_pad($sales_id, $length, '0', STR_PAD_LEFT);
        $sales->code = $sales_code;
        $sales->save();
        if($text == 'checklist'){
            $response = [
                'code'=>$sales->code,
                'status'=>false,
                'message'=>'Success'
            ];
        }else{
            $response = [
                'code'=>$sales->code,
                'status'=>true,
                'message'=>'Success'
            ];
        }

        return $response;
    }

    public function getSales($sale){
        $client_id = $sale->client_id;
        $client = [];
        if($client_id){
            $client = Clients::find($client_id);
        }
        $all_sale = [
            'id'=>$sale->id,
            'code'=>$sale->code,
            'client'=>$client,
            'price'=>$sale->price?number_format($sale->price, 0, '', ' '):'no',
            'sale_items'=>json_encode($this->getSalesItem($sale))
        ];
        return $all_sale;
    }

    public function getSalesItem($sale){
        $items = [];
        if($sale){
            $salesItems = $sale->salesItems;
            if(!$salesItems->isEmpty()){
                foreach($salesItems as $salesItem){
                    $product = $salesItem->product;
                    if($product){
                        $items[] = $this->productsService->getShortProduct($product, $salesItem->quantity);
                    }
                }
            }
        }
        return $items;
    }
}
