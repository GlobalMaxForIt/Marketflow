<?php

namespace App\Http\Controllers\Cashier;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Products;
use App\Models\ReturnModel;
use App\Models\Sales;
use App\Models\Clients;
use App\Models\SalesItems;
use App\Models\SalesPayments;
use App\Models\SalesReports;
use App\Service\ClientService;
use App\Service\ProductsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    public $title;
    public $current_page = 'sales';
    public $clientService;

    public function __construct(ClientService $clientService, ProductsService $productsService)
    {
        $this->clientService = $clientService;
        $this->productsService = $productsService;
        $this->title = $this->getTableTitle('Sales');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lang = App::getLocale();
        $user = Auth::user();
        $all_sales = [];
        $all_sales_info = [];
        $all_sales_modal = [];
        $all_sales_info_modal = [];
        $all_sales_info_gift_card = [];
        $clients_ = Clients::all();
        $clients = [];
        foreach($clients_ as $client){
            $clients[] = $this->clientService->getClientFullInfo($client);
        }
        $allSales = Sales::where('store_id', $user->store_id)->where('status', Constants::NOT_CHECKLIST)->get();
        foreach ($allSales as $allSale){
            $all_sales[] = $this->getSales($allSale);
            $all_sales_info[] = $this->getSalesItem($allSale);
            if($allSale->gift_card_sum){
                $all_sales_gift_card[] = [
                    'percent'=>$allSale->gift_card_percent,
                    'sum'=>$allSale->gift_card_sum
                ];
            }else{
                $all_sales_gift_card[] = [];
            }
        }
        $return_modals = ReturnModel::all()->groupBy('sale_id');
        foreach ($return_modals as $key => $return_modal_){
            $return_modal_all_sum = 0;
            $sales_modal = Sales::find($key);
            foreach($return_modal_ as $return_modal){
                $return_modal_all_sum = $return_modal_all_sum + (int)$return_modal->price;
                $sale_item_modal = $return_modal->salesItem;
                $all_sales_info_modal[] = $this->getSaleItem($sale_item_modal, $return_modal);
                if($allSale->gift_card_sum){
                    $all_sales_info_gift_card[] = [
                        'percent'=>$allSale->gift_card_percent,
                        'sum'=>$allSale->gift_card_sum
                    ];
                }else{
                    $all_sales_info_gift_card[] = [];
                }
            }
            $all_sales_modal[] = $this->getSalesModal($sales_modal, $return_modal_all_sum);
        }
        return view('cashier.payments.index', [
            'lang'=>$lang,
            'all_sales'=>$all_sales,
            'all_sales_modal'=>$all_sales_modal,
            'clients'=>$clients,
            'user'=>$user,
            'all_sales_info'=>$all_sales_info,
            'all_sales_gift_card'=>$all_sales_gift_card,
            'all_sales_info_modal'=>$all_sales_info_modal,
            'all_sales_info_gift_card'=>$all_sales_info_gift_card,
            'title'=>$this->title,
            'current_page'=>$this->current_page,
            'quantity'=>[
                'all_sales'=>count($all_sales),
            ]
        ]);
    }
    public function getSales($sale){
        $client_id = $sale->client_id;
        $client_full_name = '';
        $client_info = [];
        if($client_id){
            $client = Clients::find($client_id);
            if($client){
                $client_info = $this->clientService->getClientFullInfo($client);
                $client_full_name = $this->clientService->getClientFullname($client);
            }
        }
        $all_sale = [
            'id'=>$sale->id,
            'cashier'=>$sale->cashier,
            'store'=>$sale->store,
            'code'=>'#'.$sale->code,
            'client_full_name'=>$client_full_name,
            'client_info'=>$client_info,
            'client_discount_price'=>$sale->client_discount_price?number_format($sale->client_discount_price, 0, '', ' '):'no',
            'price'=>$sale->price?number_format($sale->price, 0, '', ' '):'no',
            'discount_price'=>$sale->discount?number_format($sale->discount, 0, '', ' '):'no',
            'total_amount'=>number_format($sale->total_amount, 0, '', ' '),
            'paid_amount'=>number_format($sale->paid_amount, 0, '', ' '),
            'return_amount'=>number_format($sale->return_amount, 0, '', ' '),
            'updated_at'=>$sale->updated_at
        ];
        return $all_sale;
    }
    public function getSalesModal($sale, $return_modal_all_sum){
        $client_id = $sale->client_id;
        $client_full_name = '';
        $client_info = [];
        if($client_id){
            $client = Clients::find($client_id);
            if($client){
                $client_info = $this->clientService->getClientFullInfo($client);
                $client_full_name = $this->clientService->getClientFullname($client);
            }
        }
        $all_sale = [
            'id'=>$sale->id,
            'cashier'=>$sale->cashier,
            'store'=>$sale->store,
            'code'=>'#'.$sale->code,
            'client_full_name'=>$client_full_name,
            'client_info'=>$client_info,
            'price'=>$return_modal_all_sum>0?number_format($return_modal_all_sum, 0, '', ' '):'no',
            'updated_at'=>$sale->updated_at
        ];
        return $all_sale;
    }
    public function getSalesItem($sale){
        $products_data = [];
        if($sale){
            $salesItems = $sale->salesItems;
            if(!$salesItems->isEmpty()){
                foreach($salesItems as $salesItem){
                    $items = [];
                    $product = $salesItem->product;
                    $sales_item_all_price = ((int)$salesItem->price - (int)$salesItem->discount_price) * (float)$salesItem->quantity;
                    $sales_item_price = (int)$salesItem->price * (int)$salesItem->quantity;
                    if($product){
                        $items = $this->productsService->getShortProduct($product, $salesItem->quantity);
                    }
                    $sales_item_quantity = $salesItem->quantity?rtrim(rtrim($salesItem->quantity, '0'), '.'):0;
                    $products_data[] = [
                        'id'=>$salesItem->id,
                        'items'=>$items,
                        'all_price'=>number_format($sales_item_all_price, 0, '', ' '),
                        'quantity'=>$sales_item_quantity,
                        'price'=>number_format($sales_item_price, 0, '', ' '),
                    ];
                }
            }
        }
        return $products_data;
    }

    public function getSaleItem($salesItem, $return_modal){
        $items = [];
        $product = $salesItem->product;
        $sales_item_all_price = $return_modal->price;
        if($product){
            $items = $this->productsService->getShortProduct($product, $salesItem->quantity);
        }
        $sales_item_quantity = $salesItem->quantity?rtrim(rtrim($return_modal->quantity, '0'), '.'):0;
        $product_data[] = [
            'id'=>$salesItem->id,
            'items'=>$items,
            'all_price'=>number_format($sales_item_all_price, 0, '', ' '),
            'quantity'=>$sales_item_quantity,
            'price'=>0,
        ];
        return $product_data;
    }

    function paymentDeleteFunc(Request $request){
        $user = Auth::user();
        $sales = Sales::where('store_id', $user->store_id)->where('id', $request->sale_id)->first();
        if($sales){
            $salesItems = $sales->salesItems;
            $salesPayment = $sales->salesPayment;
            $salesReport = $sales->salesReport;
            foreach($salesItems as $salesItem){
                $salesItem->delete();
            }
            if($salesPayment){
                $salesPayment->delete();
            }
            if($salesReport){
                $salesReport->delete();
            }
            $sales->delete();
            $response = [
                'code'=>$sales->code,
                'status'=>true,
                'message'=>'Success'
            ];
        }

        return response()->json($response, 200);
    }

    function confirmReturn(Request $request){
        $user = Auth::user();
        date_default_timezone_set("Asia/Tashkent");
        $datas = $request->data;
        $id = $request->id;

        $all_price = 0;
        $all_cost_price = 0;
        $order_discount_price = 0;
        $return_all_sum = 0;
        foreach($datas as $data_) {
            $data = json_decode($data_);
            $sales_item = SalesItems::find($data->sales_item_id);
            if($sales_item){
                $product = Products::find($sales_item->product_id);
                $return_model = new ReturnModel();
                $return_model->sale_id = $sales_item->sale_id;
                $return_model->sale_item_id = $sales_item->id;
                $return_model->product_id = $sales_item->product_id;
                $return_model->quantity = (float)$data->quantity;

                $return_model->price = $data->all_sum;
//                    $return_model->reason = $data->reason;
                $return_model->cashier_id = $user->id;
                $return_model->save();
                if($product){
                    $product->stock = (int)$product->stock + (float)$data->quantity;
                    $sales_item->quantity = (float)$sales_item->quantity - (float)$data->quantity;
                    $return_all_sum = $return_all_sum + $data->all_sum;
                    $sales_item->save();
                    $product->save();
                }
            }
        }
        $sale = Sales::find($id);
        $salesItems = $sale->salesItems;
        foreach($salesItems as $salesItem) {
            $order_data_price = (int)$salesItem->price;
            $order_data_discount = (int)$salesItem->discount_percent;
            $all_price = $all_price + (float)$salesItem->quantity * $order_data_price;
            $order_discount_price = $order_discount_price + (float)$salesItem->quantity * $order_data_discount;
            $product = Products::find($salesItem->id);
            if($product) {
                $all_cost_price = $all_cost_price + (int)$product->cost * (float)$salesItem->quantity;
            }
        }

        $salesReport = $sale->salesReport;
        if($salesReport){
            $salesReport->delete();
        }

        $discount_modal_percent = 0;
        if($sale->client_id){
            $discount_modal = Discount::where('client_id', $sale->client_id)->first();
            if($discount_modal){
                $discount_modal_percent = (int)$discount_modal->percent/100;
            }
        }
        if($discount_modal_percent == 0){
            $client_dicount_price = 0;
        }

        $sale->price = $all_price;
        $sale->discount = $order_discount_price;
        $sale->client_discount_price = $client_dicount_price;
        $total_price = $all_price - $order_discount_price - $client_dicount_price;
        $sale->return_amount = (int)$sale->return_amount + $return_all_sum;
        $sale->total_amount = $total_price;
        $sale->save();

        if($all_cost_price>0){
            $sales_reports = new SalesReports();
            $sales_reports->sale_id = $sale->id;
            $sales_reports->report_date = date('Y-m-d H:i:s');
            $sales_reports->revenue = $all_price;
            $sales_reports->profit = $all_price - $all_cost_price;
            $sales_reports->save();
        }
        $response = [
            'code'=>$sale->code,
            'return_all_sum'=>$return_all_sum,
            'status'=>true,
            'message'=>'Success'
        ];

        return response()->json($response, 200);
    }
}
