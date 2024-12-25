<?php

namespace App\Http\Controllers\Cashier;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Sales;
use App\Models\Clients;
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
        $clients_ = Clients::all();
        $clients = [];
        foreach($clients_ as $client){
            $clients[] = $this->clientService->getClientFullInfo($client);
        }
        $allSales = Sales::where('store_id', $user->store_id)->where('status', Constants::NOT_CHECKLIST)->get();
        foreach ($allSales as $allSale){
            $all_sales[] = $this->getSales($allSale);
            $all_sales_info[] = $this->getSalesItem($allSale);
        }
        return view('cashier.payments.index', [
            'lang'=>$lang,
            'all_sales'=>$all_sales,
            'clients'=>$clients,
            'all_sales_info'=>$all_sales_info,
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
            'code'=>$sale->code,
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

        return response()->json($response);
    }
}
