<?php

namespace App\Http\Controllers;

use App\Events\PostNotification;
use App\Models\Sales;
use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use App\Models\GiftCard;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class GiftCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $lang;

    public function __construct()
    {
        $this->lang = App::getLocale();
    }

    public function index()
    {
        $user = Auth::user();
        $gift_cards = GiftCard::where('store_id', $user->store_id)->get();
        return view('gift-cards.index', ['gift_cards'=> $gift_cards, 'lang'=>$this->lang, 'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gift-cards.create', ['lang'=>$this->lang]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $gift_card = new GiftCard();
        $is_exist_gift_card = GiftCard::where('name', $request->name)->first();
        if(!$is_exist_gift_card){
            $gift_card->name = $request->name;
            if ($request->coupon_type == "price") {
                $gift_card->price = $request->price;
                $gift_card->percent = NULL;
            }elseif ($request->coupon_type == "percent") {
                $gift_card->price = NULL;
                $gift_card->percent = $request->percent;
            }
            $gift_card->min_price = $request->min_price;
            $start_end_date_ = [];
            if($request->start_end_date){
                $start_end_date_ = explode(' ', $request->start_end_date);
            }
            if(isset($start_end_date_[0])){
                $gift_card->start_date = $start_end_date_[0];
            }
            if(isset($start_end_date_[2])){
                $gift_card->end_date = $start_end_date_[2];
            }
            $gift_card->store_id = $user->store_id;
            $gift_card->save();
            return redirect()->route('gift-cards.index')->with('status', translate_title('Successfully created', $this->lang));
        }else{
            $code_is_exist = $request->name.' '.translate_title('is exist. Enter another one', $this->lang);
            return redirect()->back()->with('status', $code_is_exist);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $gift_card = GiftCard::where('store_id', $user->store_id)->where('id', $id)->first();
        $start_date = explode(' ', $gift_card->start_date);
        $end_date = explode(' ', $gift_card->end_date);
        if(isset($start_date[0]) && isset($end_date[0])){
            $start_end_date = $start_date[0].' to '.$end_date[0];
        }else{
            $start_end_date = '';
        }
        return view('gift-cards.edit', ['gift_card'=> $gift_card, 'start_end_date'=>$start_end_date, 'user'=>$user, 'lang'=>$this->lang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $gift_card = GiftCard::where('store_id', $user->store_id)->where('id', $id)->first();
        $gift_card->name = $request->name;
        $is_exist_gift_card = GiftCard::where('name', $request->name)->first();
        if(!$is_exist_gift_card){
            if ($request->coupon_type == "price") {
                $gift_card->price = $request->price;
                $gift_card->percent = NULL;
            } elseif ($request->coupon_type == "percent") {
                $gift_card->price = NULL;
                $gift_card->percent = $request->percent;
            }
            $gift_card->min_price = $request->min_price;
            $start_end_date_ = [];
            if($request->start_end_date){
                $start_end_date_ = explode(' ', $request->start_end_date);
            }
            if(isset($start_end_date_[0])){
                $gift_card->start_date = $start_end_date_[0];
            }
            if(isset($start_end_date_[2])){
                $gift_card->end_date = $start_end_date_[2];
            }
            $gift_card->store_id = $user->store_id;
            $gift_card->save();
            return redirect()->route('gift-cards.index')->with('status', translate_title('Successfully created', $this->lang));
        }else{
            $code_is_exist = $request->name.' '.translate_title('is exist. Enter another one', $this->lang);
            return redirect()->back()->with('status', $code_is_exist);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $model = GiftCard::where('store_id', $user->store_id)->where('id', $id)->first();
        $model->delete();
        return redirect()->route('gift-cards.index')->with('status', translate_title('Successfully created', $this->lang));
    }

    public function giftCard(Request $request){
        $user = Auth::user();
        date_default_timezone_set("Asia/Tashkent");
        $gift_card_code = $request->gift_card_code;
        $get_total_sum = $request->get_total_sum;
        $time_now = date('Y-m-d');
        $lang = App::getLocale();
        $gift_card = GiftCard::where('name', $gift_card_code)->where('start_date', '<=', $time_now)->where('end_date', '>=', $time_now)->where('store_id', $user->store_id)->first();
        $data = [];
        $status = false;
        $users = User::where('store_id', $user->store_id)->get();
        $this_store_users_id = User::where('store_id', $user->store_id)->pluck('id');
        $message_data = 'Apple 1kg '.translate_title('has left ', $lang). ' 5';

        event(new PostNotification($message_data, $this_store_users_id));
//        Notification::send($users, new OrderNotification($data));


        if($gift_card){
            if((int)$get_total_sum >= (int)$gift_card->min_price){
                if($gift_card->price){
                    $price = (int)$gift_card->price;
                }else{
                    $price = (int)((int)$get_total_sum * $gift_card->percent/100);
                }
                $message = translate_title('Successfully set', $this->lang).' '. number_format($price, 0, '', ' ');
                $data = [
                    'price'=>$price,
                    'percent'=>$gift_card->percent??'',
                ];
                $status = true;
            }else{
                $message = $gift_card_code.' '.translate_title('Sale minimum price must be', $this->lang).' '. number_format($gift_card->min_price, 0,'',' ');
            }
        }else{
            $message = translate_title('this gift card is not found or expired', $this->lang);
        }

        $response = [
            'code'=>$gift_card_code,
            'data'=>$data,
            'status'=>$status,
            'message'=>$message
        ];
        return response()->json($response, 200);
    }
}
