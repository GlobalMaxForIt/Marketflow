<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Models\Clients;
use App\Models\Discount;
use App\Models\Products;
use App\Models\ProductsCategories;
use App\Service\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CashierDiscountController extends Controller
{
    public $title;
    public $clientService;
    public $lang;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
        $this->title = $this->getTableTitle('Discount');
    }

    public function index()
    {
        $lang = App::getLocale();
        $products_categories = ProductsCategories::where('step', 0)->orderBy('id', 'asc')->get();
        $discounts_distinct = Discount::distinct('discount_number')->whereNull('client_id')->get();
        $discounts_client_distinct = Discount::distinct('discount_number')->whereNotNull('client_id')->get();
        $discount_clients_id = Discount::distinct('client_id')->whereNotNull('client_id')->pluck('client_id');
        $discounts_data = [];
        $discounts_client_data = [];
        $clients = [];
        $clients_ = Clients::all();
        foreach($clients_ as $client){
            $clients[] = $this->clientService->getClientFullInfo($client);
        }
        $clients_for_discount = [];
        $clients__ = Clients::whereNotIn('id', $discount_clients_id)->get();
        foreach($clients__ as $client__){
            $clients_for_discount[] = $this->clientService->getClientFullInfo($client__);
        }
        foreach ($discounts_distinct as $discount_distinct) {
            $discounts_data[] = $this->getOneDiscount($discount_distinct);
        }
        foreach ($discounts_client_distinct as $discount_client_distinct) {
            $client_full_name = '';
            if($discount_client_distinct->client){
                $client_full_name = $this->clientService->getClientFullname($discount_client_distinct->client);
            }
            $discounts_client_data[] = [
                'id'=>$discount_client_distinct->id,
                'percent'=>$discount_client_distinct->percent,
                'client'=>$discount_client_distinct->client,
                'client_full_name'=>$client_full_name,
                'discount_number'=>$discount_client_distinct->discount_number,
                'start_date'=>$discount_client_distinct->start_date,
                'end_date'=>$discount_client_distinct->end_date
            ];
        }
        return view('cashier.discount.index', [
            'discounts_data'=> $discounts_data,
            'discounts_client_data'=> $discounts_client_data,
            'products_categories'=>$products_categories,
            'title'=>$this->title,
            'clients'=>$clients,
            'clients_for_discount'=>$clients_for_discount,
            'lang'=>$lang
        ]);
    }

    public function getOneDiscount($discount_distinct){
        $subcategory = [];
        $category = [];
        $discount_number = Discount::where('discount_number', $discount_distinct->discount_number)->count();
        $discount_data = Discount::where('discount_number', $discount_distinct->discount_number)->get();
        foreach($discount_data as $discount__data){
            $category_ = $discount__data->category;
            $subCategory_ = $discount__data->subCategory;
            if($category_){
                $category_name = $category_->name;
                if($category_name){
                    if(!in_array($category_name, $category)){
                        $category[] = $category_name;
                    }
                }
                $subcategory = [1, 2];
            }elseif($subCategory_){
                if($subCategory_->category){
                    if($subCategory_->category->name){
                        if(!in_array($subCategory_->category->name, $category)){
                            $category[] = $subCategory_->category->name;
                        }
                    }
                }
                if($subCategory_->name){
                    if(!in_array($subCategory_->name, $subcategory)){
                        $subcategory[] = $subCategory_->name;
                    }
                }
            }
        }
        if(count($category) == 1){
            $category = [$category[0]];
        }elseif(count($category) > 1){
            $category = [translate_title('All categories', $this->lang)];
        }else{
            $category = [''];
        }

        if(count($subcategory) == 1){
            $subcategory = [$subcategory[0]];
        }elseif(count($subcategory) > 1){
            $subcategory = [translate_title('All subcategories', $this->lang)];
        }else{
            $subcategory = [''];
        }
        $discounts_data = [
            'discount'=>$discount_data,
            'number'=>$discount_number,
            'category'=>$category,
            'subcategory'=>$subcategory,
        ];
        return $discounts_data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lang = App::getLocale();
        $categories = ProductsCategories::where('step', 0)->orderBy('id', 'asc')->get();
        return view('cashier.discount.create', [
            'categories'=>$categories,
            'lang'=>$lang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(DiscountRequest $request)
    {
        $current_discount = new Discount();
        $this->saveDiscount($request, $current_discount, 'store');
        return redirect()->route('cashier-discount.index')->with('success', translate_title('Successfully created', $this->lang));
    }

    public function getProducts($request){

        if(isset($request->product_id) && $request->product_id != "all" && $request->product_id){
            $products = Products::where('id', $request->product_id)->get();
        }elseif(isset($request->products_sub_categories_id) && $request->products_sub_categories_id != "all" && $request->products_sub_categories_id){
            $products = Products::where('products_categories_id', $request->products_sub_categories_id)->get();
        }elseif(isset($request->products_categories_id) && $request->products_categories_id && $request->products_categories_id != 'all'){
            $sub_categories_id = ProductsCategories::where(['step'=> 1, 'parent_id'=>$request->products_categories_id])->pluck('id')->all();
            $sub_categories_id[] = (int)$request->products_categories_id;
            $products = Products::whereIn('products_categories_id', $sub_categories_id)->get();
        }elseif($request->products_categories_id == 'all'){
            $products_categories = ProductsCategories::where('step', 0)->get();
            $sub_categories_id = [];
            foreach($products_categories as $products_category){
                $sub_categories_id_ = ProductsCategories::where(['step'=> 1, 'parent_id'=>$products_category->id])->pluck('id')->all();
                $sub_categories_id = array_merge($sub_categories_id, $sub_categories_id_);
                $sub_categories_id[] = $products_category->id;
            }
            $products = Products::whereIn('products_categories_id', $sub_categories_id)->get();
        }else{
            return [];
        }
        return $products;
    }

    public function newDiscount($request, $category_id){
        $discount = new Discount();
        $discount->percent = $request->percent;
        $start_end_date = [];
        if($request->start_end_date){
            $start_end_date = explode(' ', $request->start_end_date);
        }
        if(isset($start_end_date[0])){
            $discount->start_date = $start_end_date[0];
        }
        if(isset($start_end_date[2])){
            $discount->end_date = $start_end_date[2];
        }
        if(isset($request->products_sub_categories_id) && $request->products_sub_categories_id != "all" && $request->products_sub_categories_id){
            $discount->products_categories_id = $request->products_sub_categories_id;
        }elseif(isset($request->products_categories_id) && $request->products_categories_id && $request->products_categories_id != 'all'){
            $discount->products_categories_id = $request->products_categories_id;
        }else{
            $discount->products_categories_id = $category_id;
        }
        return $discount;
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
        $lang = App::getLocale();
        $discount = Discount::find($id);
        $clients = [];
        $clients_ = Clients::all();
        foreach($clients_ as $client){
            $clients[] = $this->clientService->getClientFullInfo($client);
        }

        $discount_clients_id = Discount::distinct('client_id')->whereNotNull('client_id')->pluck('client_id')->toArray();
        $key = array_search($discount->client_id, $discount_clients_id);
        if($key !== false){
            unset($discount_clients_id[$key]);
        }
        $clients_for_discount = [];
        $clients__ = Clients::whereNotIn('id', $discount_clients_id)->get();
        foreach($clients__ as $client__){
            $clients_for_discount[] = $this->clientService->getClientFullInfo($client__);
        }
        $categories = ProductsCategories::where('step', 0)->orderBy('id', 'asc')->get();
        $category_id = [];
        $subcategory_id = [];
        $quantity = 0;
        $discount_data = Discount::where('discount_number', $discount->discount_number)->get();
        foreach($discount_data as $discount__data){
            $quantity++;
            if($discount__data->category){
                if(!in_array($discount__data->category->id, $category_id)){
                    $category_id[] = $discount__data->category->id;
                }
                $subcategory_id = ['a', 'a'];
            }elseif($discount__data->subCategory){
                if($discount__data->subCategory->category){
                    if(!in_array($discount__data->subCategory->category->id, $category_id)){
                        $category_id[] = $discount__data->subCategory->category->id;
                    }
                }
                if(!in_array($discount__data->subCategory->id, $subcategory_id)){
                    $subcategory_id[] = $discount__data->subCategory->id;
                }
            }
        }

        $start_date = explode(' ', $discount->start_date);
        $end_date = explode(' ', $discount->end_date);
        if(isset($start_date[0]) && isset($end_date[0])){
            $start_end_date = $start_date[0].' to '.$end_date[0];
        }else{
            $start_end_date = '';
        }
        if(count($category_id) == 1){
            $category_id = $category_id[0];
        }elseif(count($category_id) > 1){
            $category_id = 'two';
        }else{
            $category_id = '';
        }

        if(count($subcategory_id) == 1){
            $subcategory_id = $subcategory_id[0];
        }elseif(count($subcategory_id) > 1){
            $subcategory_id = 'two';
        }else{
            $subcategory_id = '';
        }

        return view('cashier.discount.edit', [
            'discount'=> $discount,
            'categories'=>$categories,
            'clients'=>$clients,
            'clients_for_discount'=>$clients_for_discount,
            'category_id'=>$category_id,
            'subcategory_id'=>$subcategory_id,
            'start_end_date'=>$start_end_date,
            'quantity'=>$quantity,
            'title'=>$this->title,
            'lang'=>$lang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $current_discount = Discount::find($id);
        $this->saveDiscount($request, $current_discount, 'update');
        return redirect()->route('cashier-discount.index')->with('success', translate_title('Successfully updated', $this->lang));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $current_discount = Discount::find($id);
        $current_discount_group = Discount::where('discount_number', $current_discount->discount_number)->get();
        foreach ($current_discount_group as $currentDiscount){
            $currentDiscount->delete();
        }
        return redirect()->route('cashier-discount.index')->with('success', translate_title('Successfully created', $this->lang));
    }

    public function saveDiscount($request, $current_discount, $type){
        $discount_ = Discount::orderBy('discount_number', 'desc')->first();
        if($discount_){
            $discount_number = $discount_->discount_number + 1;
        }else{
            $discount_number = 1;
        }

        if(isset($request->client_id)){
            $current_discount->client_id = $request->client_id;
            $current_discount->discount_number = $discount_number;
            $current_discount->percent = $request->percent;
            $start_end_date_ = [];
            if($request->start_end_date){
                $start_end_date_ = explode(' ', $request->start_end_date);
            }
            if(isset($start_end_date_[0])){
                $current_discount->start_date = $start_end_date_[0];
            }
            if(isset($start_end_date_[2])){
                $current_discount->end_date = $start_end_date_[2];
            }
            $current_discount->save();
        }else{
            $products = $this->getProducts($request);
            if($products->isEmpty()){
                return redirect()->back()->with('error', translate_title('There is no product in this category', $this->lang));
            }
            if($type == 'update'){
                $current_discount_group = Discount::where('discount_number', $current_discount->discount_number)->get();
                foreach ($current_discount_group as $currentDiscount){
                    $currentDiscount->delete();
                }
            }
            foreach($products as $product){
                $discount = $this->newDiscount($request, $product->category_id);
                $discount->product_id = $product->id;
                $discount->discount_number = $discount_number;
                $discount->save();
            }
        }
    }
}
