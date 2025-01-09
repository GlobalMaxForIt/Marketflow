<?php

namespace App\Service;


use App\Constants;
use App\Events\PostNotification;
use App\Models\Cashback;
use App\Models\CashbackType;
use App\Models\Clients;
use App\Models\Discount;
use App\Models\giftCard;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use App\Models\SalesItems;
use App\Models\SalesPayments;
use App\Models\SalesReports;
use App\Models\ServicePrice;
use App\Models\User;
use App\Notifications\StockNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;

class SalesService
{
    public $clienService;
    public $productsService;

    public function __construct(ClientService $clientService, ProductsService $productsService)
    {
        $this->clienService = $clientService;
        $this->productsService = $productsService;
    }

    public function salesItemsSave($sales, $client_dicount_price, $client_id, $order_data, $paid_amount, $return_amount, $card_sum, $cash_sum, $gift_card, $text, $checklist_changed, $debt_sum, $user){
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
                    $this_store_users_id = User::where('store_id', $user->store_id)->pluck('id');
                    $users = User::where('store_id', $user->store_id)->get();
                    $product_small_image = storage_path('app/public/products/small/'.$product->image);
                    if(file_exists($product_small_image)){
                        $small_image = asset('storage/products/small/'.$product->image);
                    }else{
                        $small_image = asset('icon/no_photo.jpg');
                    }
                    $product_data = [
                        'product_image'=>$small_image,
                        'product_id'=>$product->id,
                        'message'=>$message,
                    ];
                    Notification::send($users, new StockNotification($product_data));
                    event(new PostNotification($product_data, $this_store_users_id));
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
        $gift_data = [];
        $price = 0;
        $gift_card_code = '';
        if($gift_card){
            $gift_card_code = $gift_card->name;
            if($gift_card->price){
                $price = (int)$gift_card->price;
            }else{
                $price = (int)((int)$total_price * $gift_card->percent/100);
            }
            $gift_data = [
                'price'=>$price,
                'percent'=>$gift_card->percent??'',
            ];
            $sales->gift_card_sum = $price;
            $sales->gift_card_percent = $gift_card->percent;
        }
        $total_price = $total_price - $price;
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
        $cashback = Cashback::where('client_id', $client_id)->first();
        if($cashback){
            $cashback->client_expenses = (int)$cashback->client_expenses + $total_price;
            $cashback_type = $cashback->cashback_type;
            $cashback_for_bilion = (int)$cashback->client_expenses/1000000;
            if($cashback_for_bilion >0){
                $current_cashback_sum = (int)($cashback_for_bilion*((int)$cashback_type->percent/100));
                if($current_cashback_sum>0){
                    $cashback->all_sum = $current_cashback_sum;
                    $cashback->left_sum = $current_cashback_sum - (int)$cashback->taken_sum;
                    $cashback->save();
                }
            }
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
            $status = false;
        }else{
            $status = true;
        }
        $response = [
            'code'=>$sales->code,
            'gift_card_code'=>$gift_card_code,
            'gift_data'=>$gift_data,
            'status'=>$status,
            'message'=>'Success'
        ];

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
