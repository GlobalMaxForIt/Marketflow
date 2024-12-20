<?php

namespace App\Http\Controllers\Cashier;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Discount;
use App\Models\Products;
use App\Models\ProductsCategories;
use App\Models\Sales;
use App\Models\User;
use App\Service\ClientService;
use App\Service\ProductsCategoriesService;
use App\Service\ProductsService;
use App\Service\SalesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CashboxController extends Controller
{

    public $title;
    public $clientService;
    public $productsCategoriesService;
    public $salesService;
    public $productsService;
    public $lang;
    public $current_page = 'cashbox';

    public function __construct(ClientService $clientService, ProductsCategoriesService $productsCategoriesService, SalesService $salesService, ProductsService $productsService)
    {
        $this->clientService = $clientService;
        $this->productsCategoriesService = $productsCategoriesService;
        $this->salesService = $salesService;
        $this->productsService = $productsService;
        $this->title = $this->getTableTitle('Cashbox');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lang = App::getLocale();
        $user = Auth::user();
        $cashiers = User::select('id','name', 'surname')->where('store_id', $user->store_id)->get();
        $clients_ = Clients::all();
        $language = App::getLocale();
        $clients = [];
        foreach($clients_ as $client){
            $clients[] = $this->clientService->getClientFullInfo($client);
        }
        $discount_clients_id = Discount::distinct('client_id')->whereNotNull('client_id')->pluck('client_id')->toArray();
        $clients_for_discount = [];
        $clients__ = Clients::whereIn('id', $discount_clients_id)->get();
        foreach($clients__ as $client__){
            if($client__->discount){
                $clients_for_discount[] = [
                    'client_full_name'=>$this->clientService->getClientFullname($client__),
                    'percent'=>(int)$client__->discount->percent,
                    'client_id'=>(int)$client__->id
                ];
            }
        }
        $discount_clients = Discount::distinct('client_id')->whereNotNull('client_id')->pluck('client_id');
        $clients_discount_ = Clients::whereIn('id', $discount_clients)->get();
        $clients_discount = [];
        foreach($clients_discount_ as $client_discount){
            $clients_discount[] = $this->clientService->getClientFullInfo($client_discount);
        }
        $products_categories = ProductsCategories::where('step', 0)->get();
        $productsSubCategories = [];
        $allProducts = [];
        $allCategriesSubcategoriesProducts = [];
        $allProductsData[] = [
            'products'=>[],
            'quantity'=>0,
        ];
        foreach($products_categories as $category){
            $allSubcategoriesProducts = [];
            $sub_categories = $category->subcategory;
            $productsSubCategories[$category->id] = $category->subcategory;
            foreach($sub_categories as $sub_category){
                $products_ = Products::orderBy('created_at', 'desc')->where('products_categories_id', $sub_category->id)->where('store_id', $user->store_id)->get();
                $allProductsNames = [];
                foreach ($products_ as $product) {
                    if($product->discount){
                        if($product->discount->percent&& $product->price){
                            $discount = $this->getDiscount($product->discount->percent, $product->price);
                            $discount_percent = $product->discount->percent;
                        }else{
                            $discount = 0;
                            $discount_percent = 0;
                        }
                    }else{
                        $discount = 0;
                        $discount_percent = 0;
                    }
                    $array_products = [
                        'id'=>$product->id,
                        'products_categories'=>$product->products_categories,
                        'name'=>$product->name,
                        'amount'=>$product->amount,
                        'price'=>number_format((int)$product->price, 0, '', ' '),
                        'discount'=>number_format($discount, 0, '', ' '),
                        'discount_percent'=>$discount_percent,
                        'last_price'=>number_format((int)$product->price - $discount, 0, '', ' '),
                        'barcode'=>$product->barcode,
                        'stock'=>$product->stock,
                    ];
                    $allProducts[] = $array_products;

                    $allProductsNames[] = $array_products;
                }

                $sub_category_name = $this->productsCategoriesService->getCategoryName($sub_category, $language);
                $allSubcategoriesProducts[] = [
                    'sub_category_name'=>$sub_category_name,
                    'products'=>$allProductsNames
                ];
            }
            $category_name = $this->productsCategoriesService->getCategoryName($category, $language);

            $allCategriesSubcategoriesProducts[] = [
                'category_name'=>$category_name,
                'sub_categories'=>$allSubcategoriesProducts
            ];
        }
        $allProductsData = [
            'products'=>$allProducts,
            'json_products'=>json_encode($allProducts),
            'quantity'=>count($allProducts),
        ];

        return view('cashier.cashbox.index', [
            'allProductsData'=>$allProductsData,
            'allCategriesSubcategoriesProducts'=>$allCategriesSubcategoriesProducts,
            'title'=>$this->title,
            'user'=>$user,
            'clients'=>$clients,
            'cashiers'=>$cashiers,
            'clients_for_discount'=>$clients_for_discount,
            'clients_discount'=>$clients_discount,
            'lang'=>$lang,
            'current_page'=>$this->current_page
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexLarge()
    {
        $lang = App::getLocale();
        $user = Auth::user();
        $cashiers = User::select('id','name', 'surname')->where('store_id', $user->store_id)->get();
        $clients_ = Clients::all();
        $clients = [];
        foreach($clients_ as $client){
            $clients[] = $this->clientService->getClientFullInfo($client);
        }
        $discount_clients_id = Discount::distinct('client_id')->whereNotNull('client_id')->pluck('client_id')->toArray();
        $clients_for_discount = [];
        $clients__ = Clients::whereIn('id', $discount_clients_id)->get();
        foreach($clients__ as $client__){
            $client_all_total_sum = 0;
            if($client__->discount){
                $clients_for_discount[] = [
                    'client_all_total_sum'=>$client_all_total_sum,
                    'client_full_name'=>$this->clientService->getClientFullname($client__),
                    'percent'=>(int)$client__->discount->percent,
                    'client_id'=>(int)$client__->id,
                    'phone'=>$client__->phone,
                ];
            }
        }
        $discount_clients = Discount::distinct('client_id')->whereNotNull('client_id')->pluck('client_id');
        $clients_discount_ = Clients::whereIn('id', $discount_clients)->get();
        $clients_discount = [];
        foreach($clients_discount_ as $client_discount){
            $clients_discount[] = $this->clientService->getClientFullInfo($client_discount);
        }
        $allProductsData[] = [
            'products'=>[],
            'quantity'=>0,
        ];
        $products_ = Products::orderBy('created_at', 'desc')->where('store_id', $user->store_id)->get();
        $products_fast = Products::orderBy('created_at', 'desc')->where('store_id', $user->store_id)->whereNotNull('fast_selling_goods')->get();
        $products_json = Products::where('store_id', $user->store_id)->whereNotNull('barcode')->get();
        $allProducts = $this->productsService->getProducts($products_);
        $allProductsFast = $this->productsService->getProducts($products_fast);
        $allProductsJson = $this->productsService->getProducts($products_json);
        $allProductsData = [
            'products'=>$allProducts,
            'products_fast'=>$allProductsFast,
            'json_products'=>json_encode($allProductsJson),
            'quantity'=>count($allProducts),
        ];

        $check_lists = Sales::where('status', Constants::CHECKLIST)->get();

        $all_checklist_sales = [];
        foreach($check_lists as $check_list){
            $all_checklist_sales[] = $this->salesService->getSales($check_list);
        }
        return view('cashier.cashbox.index_large', [
            'allProductsData'=>$allProductsData,
            'title'=>$this->title,
            'user'=>$user,
            'clients'=>$clients,
            'cashiers'=>$cashiers,
            'all_checklist_sales'=>json_encode($all_checklist_sales),
            'clients_for_discount'=>$clients_for_discount,
            'clients_discount'=>$clients_discount,
            'lang'=>$lang,
            'current_page'=>$this->current_page
        ]);
    }

    public function getCheckAside(){
        $all_checklist_sales = [];
        $check_lists = Sales::where('status', Constants::CHECKLIST)->get();
        foreach($check_lists as $check_list){
            $all_checklist_sales[] = $this->salesService->getSales($check_list);
        }
        return response()->json($all_checklist_sales);
    }
    /**
     * Display a listing of the resource.
     */
    public function indexSmall()
    {
        $lang = App::getLocale();
        $user = Auth::user();
        $cashiers = User::select('id','name', 'surname')->where('store_id', $user->store_id)->get();
        $clients_ = Clients::all();
        $clients = [];
        foreach($clients_ as $client){
            $clients[] = $this->clientService->getClientFullInfo($client);
        }
        $discount_clients_id = Discount::distinct('client_id')->whereNotNull('client_id')->pluck('client_id')->toArray();
        $clients_for_discount = [];
        $clients__ = Clients::whereIn('id', $discount_clients_id)->get();
        foreach($clients__ as $client__){
            if($client__->discount){
                $clients_for_discount[] = [
                    'client_full_name'=>$this->clientService->getClientFullname($client__),
                    'percent'=>(int)$client__->discount->percent,
                    'client_id'=>(int)$client__->id
                ];
            }
        }
        $discount_clients = Discount::distinct('client_id')->whereNotNull('client_id')->pluck('client_id');
        $clients_discount_ = Clients::whereIn('id', $discount_clients)->get();
        $clients_discount = [];
        foreach($clients_discount_ as $client_discount){
            $clients_discount[] = $this->clientService->getClientFullInfo($client_discount);
        }
        $allProductsData[] = [
            'products'=>[],
            'quantity'=>0,
        ];
        $products_ = Products::orderBy('created_at', 'desc')->where('store_id', $user->store_id)->whereNotNull('fast_selling_goods')->get();
        $products_json = Products::where('store_id', $user->store_id)->whereNotNull('barcode')->get();
        $allProducts = $this->productsService->getProducts($products_);
        $allProductsJson = $this->productsService->getProducts($products_json);
        $allProductsData = [
            'products'=>$allProducts,
            'json_products'=>json_encode($allProductsJson),
            'quantity'=>count($allProducts),
        ];

        return view('cashier.cashbox.index_small', [
            'allProductsData'=>$allProductsData,
            'title'=>$this->title,
            'user'=>$user,
            'clients'=>$clients,
            'cashiers'=>$cashiers,
            'clients_for_discount'=>$clients_for_discount,
            'clients_discount'=>$clients_discount,
            'lang'=>$lang,
            'current_page'=>$this->current_page
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function indexold()
    {
        $lang = App::getLocale();
        $user = Auth::user();
        $cashiers = User::select('id','name', 'surname')->where('store_id', $user->store_id)->get();
        $clients_ = Clients::all();
        $language = App::getLocale();
        $clients = [];
        foreach($clients_ as $client){
            $clients[] = $this->clientService->getClientFullInfo($client);
        }
        $discount_clients_id = Discount::distinct('client_id')->whereNotNull('client_id')->pluck('client_id')->toArray();
        $clients_for_discount = [];
        $clients__ = Clients::whereIn('id', $discount_clients_id)->get();
        foreach($clients__ as $client__){
            if($client__->discount){
                $clients_for_discount[] = [
                    'client_full_name'=>$this->clientService->getClientFullname($client__),
                    'percent'=>(int)$client__->discount->percent,
                    'client_id'=>(int)$client__->id
                ];
            }
        }
        $discount_clients = Discount::distinct('client_id')->whereNotNull('client_id')->pluck('client_id');
        $clients_discount_ = Clients::whereIn('id', $discount_clients)->get();
        $clients_discount = [];
        foreach($clients_discount_ as $client_discount){
            $clients_discount[] = $this->clientService->getClientFullInfo($client_discount);
        }
        $products_categories = ProductsCategories::where('step', 0)->get();
        $productsSubCategories = [];
        $allProducts = [];
        $allCategriesSubcategoriesProducts = [];
        $allProductsData[] = [
            'products'=>[],
            'quantity'=>0,
        ];
        foreach($products_categories as $category){
            $allSubcategoriesProducts = [];
            $sub_categories = $category->subcategory;
            $productsSubCategories[$category->id] = $category->subcategory;
            foreach($sub_categories as $sub_category){
                $products_ = Products::orderBy('created_at', 'desc')->where('products_categories_id', $sub_category->id)->where('store_id', $user->store_id)->get();
                $allProductsNames = [];
                foreach ($products_ as $product) {
                    if($product->discount){
                        if($product->discount->percent&& $product->price){
                            $discount = $this->getDiscount($product->discount->percent, $product->price);
                            $discount_percent = $product->discount->percent;
                        }else{
                            $discount = 0;
                            $discount_percent = 0;
                        }
                    }else{
                        $discount = 0;
                        $discount_percent = 0;
                    }
                    $array_products = [
                        'id'=>$product->id,
                        'products_categories'=>$product->products_categories,
                        'name'=>$product->name,
                        'amount'=>$product->amount,
                        'price'=>number_format((int)$product->price, 0, '', ' '),
                        'discount'=>number_format($discount, 0, '', ' '),
                        'discount_percent'=>$discount_percent,
                        'last_price'=>number_format((int)$product->price - $discount, 0, '', ' '),
                        'barcode'=>$product->barcode,
                        'stock'=>$product->stock,
                    ];
                    $allProducts[] = $array_products;

                    $allProductsNames[] = $array_products;
                }

                $sub_category_name = $this->productsCategoriesService->getCategoryName($sub_category, $language);
                $allSubcategoriesProducts[] = [
                    'sub_category_name'=>$sub_category_name,
                    'products'=>$allProductsNames
                ];
            }
            $category_name = $this->productsCategoriesService->getCategoryName($category, $language);

            $allCategriesSubcategoriesProducts[] = [
                'category_name'=>$category_name,
                'sub_categories'=>$allSubcategoriesProducts
            ];
        }
        $allProductsData = [
            'products'=>$allProducts,
            'json_products'=>json_encode($allProducts),
            'quantity'=>count($allProducts),
        ];

        return view('cashier.cashbox.index', [
            'allProductsData'=>$allProductsData,
            'allCategriesSubcategoriesProducts'=>$allCategriesSubcategoriesProducts,
            'title'=>$this->title,
            'user'=>$user,
            'clients'=>$clients,
            'cashiers'=>$cashiers,
            'clients_for_discount'=>$clients_for_discount,
            'clients_discount'=>$clients_discount,
            'lang'=>$lang,
            'current_page'=>$this->current_page
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }



    public function paymentPay(Request $request){
        $user = Auth::user();
        date_default_timezone_set("Asia/Tashkent");
        $order_data = $request->order_data;
        $saleId = (int)$request->sale_id;
        $text = $request->text;
        $checklist_changed = $request->checklist_changed;
        if($saleId>0){
            $sales = Sales::where('store_id', $user->store_id)->where('id', $saleId)->first();
            if($text == 'checklist' && $checklist_changed == false){
                $response_ = [
                    'code'=>$sales->code,
                    'status'=>false,
                    'message'=>'Success'
                ];
                return response()->json($response_);
            }
        }else{
            $sales = new Sales();
        }
        $sales->store_id = $user->store_id;
        $sales->cashier_id = $user->id;
        $client_id = $request->client_id;
        $paid_amount = $request->paid_amount;
        $return_amount = $request->return_amount;
        $client_dicount_price = $request->client_dicount_price;
        $card_sum = $request->card_sum;
        $cash_sum = $request->cash_sum;
        $response = $this->salesService->salesItemsSave($sales, $client_dicount_price, $client_id, $order_data, $paid_amount, $return_amount, $card_sum, $cash_sum, $text, $checklist_changed);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function changeCashier(Request $request)
    {
        $currentUser = Auth::user(); // Hozirgi foydalanuvchi
        $newUser = User::find($request->cashier_id); // Yangi foydalanuvchi

        // Tekshiruv: Foydalanuvchi mavjudligi va bir xil do'konga tegishliligi
        if (!$newUser || $currentUser->store_id !== $newUser->store_id) {
            return redirect()->back()->with('error', translate_title('This user is not found or does not belong to your store.', $this->lang));
        }

        // Parolni tekshirish
        if (!Hash::check($request->password, $newUser->password)) {
            return redirect()->back()->with('error', translate_title('Invalid password for the new cashier.', $this->lang));
        }
        $token = $newUser->createToken('myapptoken')->plainTextToken;
        $newUser->token = $token;
        $newUser->save();
        // Hozirgi foydalanuvchini logout qilish
        Auth::logout();

        // Yangi foydalanuvchini login qilish
        Auth::login($newUser);

        // Sessiyani tozalash va qayta autentifikatsiya qilish
        $request->session()->regenerate();

        // Middleware orqali o'tkazish yoki kerakli sahifaga yo'naltirish
        return redirect()->route('cashier.index')->with('success', translate_title('Cashier successfully switched.', $this->lang));
    }
}
