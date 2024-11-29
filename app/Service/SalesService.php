<?php

namespace App\Service;


use App\Constants;
use App\Events\PostNotification;
use App\Models\Discount;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\ServicePrice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SalesService
{

    public function salesItemsSave($order, $client_dicount_price, $client_id, $order_data, $type){
        $order->client_id = $client_id;
        $order->save();
        $all_price = 0;
        $order_discount_price = 0;
        foreach($order_data as $orderData){
            $order_data_price = (int)str_replace(' ', '', $orderData['price']);
            $order_data_discount = (int)str_replace(' ', '', $orderData['discount']);
            $all_price = $all_price + (int)$orderData['quantity'] * $order_data_price;
            $order_discount_price = $order_discount_price + (int)$orderData['quantity'] * $order_data_discount;
            $order_items = new OrderItems();
            $order_items->order_id = $order->id;
            $order_items->product_id = $orderData['id'];
            $order_items->quantity = (int)$orderData['quantity'];
            $order_items->discount_price = $order_data_discount;
            $order_items->discount_percent = $orderData['discount_percent'];
            $order_items->price = $order_data_price;
            $order_items->status = Constants::ORDER_PENDING;
            $order_items->save();
        }
        $discount_modal_percent = 0;
        if($order->client_id){
            $discount_modal = Discount::where('client_id', $order->client_id)->first();
            if($discount_modal){
                $discount_modal_percent = (int)$discount_modal->percent/100;
            }
        }
        if($discount_modal_percent == 0){
            $client_dicount_price = 0;
        }
        if(!$order->code){
            $length = 8;
            $order_id = (string)$order->id;
            $order_code = (string)str_pad($order_id, $length, '0', STR_PAD_LEFT);
            $order->code = $order_code;
        }
        $order->price = $all_price;
        $order->discount_price = $order_discount_price;
        $order->client_discount_price = (int)$client_dicount_price;
        $total_price = $all_price - $order_discount_price - (int)$client_dicount_price;
        $service_price = 0;
        if($type == 'dine-in'){
            $servicePrice = ServicePrice::where('status', Constants::ACTIVE)->first();
            if($servicePrice){
                $service_price = $total_price * (int)$servicePrice->percent/100;
                $order->service_price = $service_price;
            }
        }

        $order->total_price = $total_price + $service_price;
        $order->save();

        $response = [
            'order_id'=>$order->id,
            'status'=>true,
            'message'=>'Success'
        ];
        return $response;
    }


}
