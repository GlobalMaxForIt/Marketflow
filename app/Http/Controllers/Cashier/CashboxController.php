<?php

namespace App\Http\Controllers\Cashier;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Discount;
use App\Models\Products;
use App\Models\ProductsCategories;
use App\Models\User;
use App\Service\ClientService;
use App\Service\ProductsCategoriesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CashboxController extends Controller
{

    public $title;
    public $clientService;
    public $productsCategoriesService;

    public function __construct(ClientService $clientService, ProductsCategoriesService $productsCategoriesService,)
    {
        $this->clientService = $clientService;
        $this->productsCategoriesService = $productsCategoriesService;
        $this->title = $this->getTableTitle('Cashbox');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
            return redirect()->back()->with('error', translate_title('This user is not found or does not belong to your store.'));
        }

        // Parolni tekshirish
        if (!Hash::check($request->password, $newUser->password)) {
            return redirect()->back()->with('error', translate_title('Invalid password for the new cashier.'));
        }

        // Hozirgi foydalanuvchini logout qilish
        Auth::logout();

        // Yangi foydalanuvchini login qilish
        Auth::login($newUser);

        // Sessiyani tozalash va qayta autentifikatsiya qilish
        $request->session()->regenerate();

        // Middleware orqali o'tkazish yoki kerakli sahifaga yo'naltirish
        return redirect()->route('cashier.index')->with('success', translate_title('Cashier successfully switched.'));
    }
}
