<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiftCard;
use Illuminate\Support\Facades\App;

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
        $coupon = new GiftCard();
        $coupon->name = $request->name;
        if ($request->coupon_type == "price") {
            $coupon->price = $request->price;
            $coupon->percent = NULL;
        }elseif ($request->coupon_type == "percent") {
            $coupon->price = NULL;
            $coupon->percent = $request->percent;
        }
        $coupon->min_price = $request->min_price;
        if ($request->coupon__type == "quantity") {
            $coupon->order_quantity = $request->order_quantity;
            $coupon->order_number = NULL;
        }elseif ($request->coupon__type == "number") {
            $coupon->order_quantity = NULL;
            $coupon->order_number = $request->order_number;
        }
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->save();
        return redirect()->route('gift-cards.index')->with('status', translate_title('Successfully created', $this->lang));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = GiftCard::find($id);
        return view('gift-cards.show', ['model'=>$model, 'lang'=>$this->lang]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = GiftCard::find($id);
        return view('gift-cards.edit', ['coupon'=> $coupon, 'lang'=>$this->lang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $coupon = GiftCard::find($id);
        $coupon->name = $request->name;
        if ($request->coupon_type == "price") {
            $coupon->price = $request->price;
            $coupon->percent = NULL;
        } elseif ($request->coupon_type == "percent") {
            $coupon->price = NULL;
            $coupon->percent = $request->percent;
        }
        if(isset($request->min_price)){
            $coupon->min_price = $request->min_price;
        }
        if ($request->coupon__type == "quantity") {
            $coupon->order_quantity = $request->order_quantity;
            $coupon->order_number = NULL;
        }elseif ($request->coupon__type == "number") {
            $coupon->order_quantity = NULL;
            $coupon->order_number = $request->order_number;
        }
        if(isset($request->start_date)){
            $coupon->start_date = $request->start_date;
        }
        if(isset($request->end_date)){
            $coupon->end_date = $request->end_date;
        }
        $coupon->save();
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
}
