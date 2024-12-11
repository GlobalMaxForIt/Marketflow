<?php

namespace App\Service;


use App\Constants;
use App\Events\PostNotification;
use App\Models\Discount;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\SalesItems;
use App\Models\ServicePrice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SalesService
{

    public function salesItemsSave($sales, $client_dicount_price, $client_id, $order_data, $type){
        $sales->client_id = $client_id;
        $sales->save();
        $all_price = 0;
        $order_discount_price = 0;
        foreach($order_data as $orderData){
            $order_data_price = (int)str_replace(' ', '', $orderData['price']);
            $order_data_discount = (int)str_replace(' ', '', $orderData['discount']);
            $all_price = $all_price + (int)$orderData['quantity'] * $order_data_price;
            $order_discount_price = $order_discount_price + (int)$orderData['quantity'] * $order_data_discount;
            $sales_items = new SalesItems();
            $sales_items->order_id = $sales->id;
            $sales_items->product_id = $orderData['id'];
            $sales_items->quantity = (int)$orderData['quantity'];
            $sales_items->discount_price = $order_data_discount;
            $sales_items->discount_percent = $orderData['discount_percent'];
            $sales_items->price = $order_data_price;
            $sales_items->save();
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
        if(!$sales->code){
            $length = 8;
            $order_id = (string)$sales->id;
            $order_code = (string)str_pad($order_id, $length, '0', STR_PAD_LEFT);
            $sales->code = $order_code;
        }
        $sales->price = $all_price;
        $sales->discount_price = $order_discount_price;
        $sales->client_discount_price = (int)$client_dicount_price;
        $total_price = $all_price - $order_discount_price - (int)$client_dicount_price;
        $service_price = 0;
        if($type == 'dine-in'){
            $servicePrice = ServicePrice::where('status', Constants::ACTIVE)->first();
            if($servicePrice){
                $service_price = $total_price * (int)$servicePrice->percent/100;
                $sales->service_price = $service_price;
            }
        }

        $sales->total_price = $total_price + $service_price;
        $sales->save();

        $response = [
            'order_id'=>$sales->id,
            'status'=>true,
            'message'=>'Success'
        ];
        return $response;
    }


}
