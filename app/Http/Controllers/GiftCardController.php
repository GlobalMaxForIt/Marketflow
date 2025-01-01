<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use App\Models\GiftCard;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

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
        $gift_cards = GiftCard::all();
        return view('gift-cards.index', ['gift_cards'=> $gift_cards, 'lang'=>$this->lang]);
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
        $gift_card = GiftCard::find($id);
        $start_date = explode(' ', $gift_card->start_date);
        $end_date = explode(' ', $gift_card->end_date);
        if(isset($start_date[0]) && isset($end_date[0])){
            $start_end_date = $start_date[0].' to '.$end_date[0];
        }else{
            $start_end_date = '';
        }
        return view('gift-cards.edit', ['gift_card'=> $gift_card, 'start_end_date'=>$start_end_date, 'lang'=>$this->lang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $gift_card = GiftCard::find($id);
        $gift_card->name = $request->name;
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
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = GiftCard::find($id);
        $model->delete();
        return redirect()->route('gift-cards.index')->with('status', translate_title('Successfully created', $this->lang));
    }

    public function giftCard(Request $request){
        $user = Auth::user();
        date_default_timezone_set("Asia/Tashkent");
        $set_gift_card_text = $request->set_gift_card_text;
        $gift_card = GiftCard::where('name', $set_gift_card_text)->first();
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
        return response()->json($response);
    }
}
