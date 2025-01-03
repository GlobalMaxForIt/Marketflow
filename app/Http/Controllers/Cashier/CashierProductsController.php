<?php

namespace App\Http\Controllers\Cashier;

use App\Events\PostNotification;
use App\Models\ProductInfo;
use App\Models\Products;
use App\Models\Unit;
use App\Http\Controllers\Controller;
use App\Models\ProductsCategories;
use App\Service\ProductsCategoriesService;
use App\Service\ProductsService;
use App\Service\SaveImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CashierProductsController extends Controller
{
    public $title;
    public $current_page = 'products';
    public $productsCategoriesService;
    public $productsService;
    public $saveImages;
    public $lang;

    public function __construct(ProductsCategoriesService $productsCategoriesService, SaveImages $saveImages, ProductsService $productsService)
    {
        $this->title = $this->getTableTitle('Products');
        $this->productsCategoriesService = $productsCategoriesService;
        $this->saveImages = $saveImages;
        $this->productsService = $productsService;
    }

    public function index()
    {
        $language = App::getLocale();
        $products_categories = ProductsCategories::where('step', 0)->get();
        $productsSubCategories = [];
        $all_products = [];
        $user = Auth::user();
        $allProducts = [];
        $allProductsData[] = [
            'products'=>[],
            'quantity'=>0,
        ];
        $units = Unit::all();
        foreach($products_categories as $category){
            $sub_categories = $category->subcategory;
            $sub_categories_quantity = count($sub_categories);
            $categoryData[] = $this->productsCategoriesService->getCategoryShortData($category, $language, $sub_categories_quantity);
            $all_sub_products = [];
            $subCategoryData = [];
            $sub_categories_id = [];
            foreach($sub_categories as $sub_category){
                $sub_categories_id[] = $sub_category->id;
                $subCategoryData[] = $this->productsCategoriesService->getCategoryShortData($sub_category, $language, 0);
                $products_ = Products::orderBy('created_at', 'desc')->where('products_categories_id', $sub_category->id)->where('store_id', $user->store_id)->get();
                $products = [];
                foreach ($products_ as $product) {
                    $unit_translation = '';
                    $product_small_image = storage_path('app/public/products/small/'.$product->image);
                    if(file_exists($product_small_image)){
                        $small_image = asset('storage/products/small/'.$product->image);
                    }else{
                        $small_image = asset('icon/no_photo.jpg');
                    }

                    if($product->discount){
                        if($product->discount->percent&& $product->price){
                            $discount = $this->getDiscount($product->discount->percent, $product->price);
                        }else{
                            $discount = 0;
                        }
                    }else{
                        $discount = 0;
                    }
                    if($product->unit){
                        $unit_translation = table_translate_title($product->unit, 'unit', $language);
                    }
                    $array_products=[
                        'id'=>$product->id,
                        'products_categories'=>$product->products_categories,
                        'name'=>$product->name,
                        'amount'=>$product->amount,
                        'stock'=>$product->stock,
                        'cost'=>$product->cost,
                        'unit'=>$unit_translation,
                        'unit_id'=>$product->unit_id,
                        'small_image'=>$small_image,
                        'price'=>number_format((int)$product->price, 0, '', ' '),
                        'discount'=>number_format($discount, 0, '', ' '),
                        'last_price'=>number_format((int)$product->price - $discount, 0, '', ' '),
                        'barcode'=>$product->barcode,
                    ];
                    $allProducts[] = $array_products;
                    $products[] = $array_products;
                    $all_sub_products[] = $array_products;
                }
                $all_products[$sub_category->id] = $products;
            }
            $productsSubCategories[$category->id] = $subCategoryData;
            foreach($sub_categories_id as $sub_category_id){
                $productsSubCategories[$sub_category_id] = $subCategoryData;
            }
            $all_products[$category->id] = $all_sub_products;
        }
        $allProductsData = [
            'products'=>$allProducts,
            'quantity'=>count($allProducts),
        ];
        return view('cashier.products.index', [
            'all_products'=>$all_products,
            'units'=>$units,
            'allProductsData'=>$allProductsData,
            'products_categories'=>$categoryData,
            'productsSubCategories'=>$productsSubCategories,
            'title'=>$this->title,
            'lang'=>$language,
            'current_page'=>$this->current_page
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($request->expired_date && $request->manufactured_date){
            if($request->manufactured_date >= $request->expired_date){
                return redirect()->back()->with('error', translate_title('Expired date must be bigger than manufactured date', $this->lang));
            }
        }
        $products = new Products();
        if($request->products_sub_categories_id){
            $products->products_categories_id = $request->products_sub_categories_id;
        }else{
            $products->products_categories_id = $request->products_categories_id;
        }
        $products->name = $request->name;
        $products->price = $request->price;
        $products->cost = $request->cost;
        $products->amount = $request->amount;
        $products->barcode = $request->barcode;
        $products->unit_id = $request->unit;
        if(in_array($request->unit, [4, 7, 8, 10, 11])){
            $products->stock = $request->stock;
        }else{
            $products->stock = (int)$request->stock;
        }
        if($request->fast_selling_goods){
            $products->fast_selling_goods = 1;
        }
        if($user->store_id){
            $products->store_id = $user->store_id;
        }
        if($user->company_id){
            $products->company_id = $user->company_id;
        }
        if($request->file('small_image')) {
            $products->image = $this->saveImages->saveSmallImage($request->file('small_image'));
        }

        $product_info = new ProductInfo();
        $product_info->description = $request->description;
        $images = $request->file('images');
        if($images){
            $product_info->images = $this->saveImages->imageSave($products, $images, 'store', 'products');
        }
        $products->save();
        $product_info->status = $request->status;
        $product_info->manufactured_date = $request->manufactured_date;
        $product_info->expired_date =  $request->expired_date;
        $product_info->product_id = $products->id;
        $product_info->save();
        return redirect()->route('cashier-product.index')->with('success', translate_title('Successfully created', $this->lang));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $units = Unit::all();
        $user = Auth::user();
        $lang = App::getLocale();
        $product = Products::where('id', $id)->where('store_id', $user->store_id)->first();
        $category_product = $product->products_categories;
        if($category_product){
            $current_category = $category_product->category;
            $current_sub_category_id = $category_product->id;
        }else{
            $current_category = 'no';
            $current_sub_category_id = 'no';
        }
        $images = [];
        $product_info = $product->product_info;
        if($product_info){
            if($product_info->images){
                $images = json_decode($product_info->images);
            }
        }

        $product_small_image = storage_path('app/public/products/small/'.$product->image);
        if(file_exists($product_small_image)){
            $small_image = asset('storage/products/small/'.$product->image);
        }else{
            $small_image = asset('icon/no_photo.jpg');
        }


        $products_categories = ProductsCategories::where('step', 0)->get();
        return view('cashier.products.edit', [
            'product'=>$product,
            'small_image'=>$small_image,
            'product_info'=>$product_info,
            'current_sub_category_id'=>$current_sub_category_id,
            'current_category'=>$current_category,
            'products_categories'=>$products_categories,
            'images'=>$images, 'title'=>$this->title,
            'units'=>$units,
            'lang'=>$lang, 'user'=>$user,
            'current_page'=>$this->current_page
        ]);
    }

    public function show(string $id)
    {
        $language = App::getLocale();
        $user = Auth::user();
        $product = Products::where('id', $id)->where('store_id', $user->store_id)->first();
        if($product){
            $images = [];
            $product_info = $product->product_info;
            $description = '';
            $unit = '';
            $store = '';
            $company = '';
            $status = '';
            if($product_info){
                if ($product_info->images) {
                    $images_ = json_decode($product_info->images);
                    $is_image = 0;
                    foreach ($images_ as $image) {
                        if(!$image){
                            $image = 'no';
                        }
                        $avatar_main = storage_path('app/public/products/' . $image);
                        if (file_exists($avatar_main)) {
                            $is_image = 1;
                            $images[] = asset("storage/products/$image");
                        }
                    }
                    if($is_image == 0){
                        $images = [asset('icon/no_photo.jpg')];
                    }
                }else{
                    $images = [asset('icon/no_photo.jpg')];
                }
                if($product_info->status == 0) {
                    $status = translate_title('Active', $this->lang);
                }elseif($product_info->status == 1) {
                    $status = translate_title('Not active', $this->lang);
                }else{
                    $status = translate_title('Active', $this->lang);
                }
                $description = $product_info->description;
                $manufactured_date = $product_info->manufactured_date;
                $expired_date = $product_info->expired_date;
            }
            $product_categories_ = $product->products_categories;
            if($product_categories_){
                $category_translation = table_translate_title($product_categories_,'products_categories', $language);
            }else{
                $category_translation = $product_categories_->name;
            }

            if($product->discount){
                if($product->discount->percent&& $product->price){
                    $discount = $this->getDiscount($product->discount->percent, $product->price);
                }else{
                    $discount = 0;
                }
            }else{
                $discount = 0;
            }
            if($product->fast_selling_goods){
                $fast_selling_goods = translate_title('Yes', $this->lang);
            }else{
                $fast_selling_goods = translate_title('No', $this->lang);
            }
            $store_ = $product->store;
            if($store_){
                $store = $store_->name;
            }
            if($product->unit){
                $unit = $product->unit->name;
            }
            $company_ = $product->company_;
            if($company_){
                $company = $company_->name;
            }
            $product_small_image = storage_path('app/public/products/small/'.$product->image);
            if(file_exists($product_small_image)){
                $small_image = asset('storage/products/small/'.$product->image);
            }else{
                $small_image = asset('icon/no_photo.jpg');
            }
            $array_product=[
                'id'=>$product->id,
                'products_categories'=>$category_translation,
                'name'=>$product->name,
                'amount'=>$product->amount,
                'price'=>number_format((int)$product->price, 0, '', ' '),
                'discount'=>number_format($discount, 0, '', ' '),
                'last_price'=>number_format((int)$product->price - $discount, 0, '', ' '),
                'description'=>$description,
                'barcode'=>$product->barcode,
                'stock'=>$product->stock,
                'cost'=>$product->cost,
                'fast_selling_goods'=>$fast_selling_goods,
                'manufactured_date'=>$manufactured_date,
                'expired_date'=>$expired_date,
                'store'=>$store,
                'company'=>$company,
                'unit'=>$unit,
                'status'=>$status,
                'images'=>$images,
                'small_image'=>$small_image,
                'created_at'=>$product->created_at,
                'updated_at'=>$product->updated_at
            ];
        }else{
            return redirect()->back()->with('status', 'array_products');
        }
        return view('cashier.products.show', ['array_product'=>$array_product, 'lang'=>$language, 'current_page'=>$this->current_page]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        if($request->expired_date && $request->manufactured_date){
            if($request->manufactured_date >= $request->expired_date){
                return redirect()->back()->with('error', translate_title('Expired date must be bigger than manufactured date', $this->lang));
            }
        }
        $products = Products::where('id', $id)->where('store_id', $user->store_id)->first();
        if($request->products_sub_categories_id){
            $products->products_categories_id = $request->products_sub_categories_id;
        }else{
            $products->products_categories_id = $request->products_categories_id;
        }
        $products->name = $request->name;
        $products->price = $request->price;
        $products->cost = $request->cost;
        $products->amount = $request->amount;
        $products->barcode = $request->barcode;
        $products->unit_id = $request->unit;
        if(in_array($request->unit, [4, 7, 8, 10, 11])){
            $products->stock = $request->stock;
        }else{
            $products->stock = (int)$request->stock;
        }
        if($user->store_id){
            $products->store_id = $user->store_id;
        }
        if($user->company_id){
            $products->company_id = $user->company_id;
        }
        if($request->fast_selling_goods){
            $products->fast_selling_goods = 1;
        }else{
            $products->fast_selling_goods = 0;
        }
        $small_image = $request->file('small_image');
        if($small_image) {
            if(!$products->image){
                $products->image = 'no';
            }
            $product_image = storage_path('app/public/products/small/'.$products->image);
            if(file_exists($product_image)){
                unlink($product_image);
            }
            $products->image = $this->saveImages->saveSmallImage($request->file('small_image'));
        }
        $product_info = $products->product_info;
        if(!$product_info) {
            $product_info = new ProductInfo();
        }
        $product_info->product_id = $products->id;
        $product_info->description = $request->description;
        $images = $request->file('images');
        if($images){
            $product_info->images = $this->saveImages->imageSave($products, $images, 'update', 'products');
        }
        $product_info->status = $request->status;
        $product_info->manufactured_date = $request->manufactured_date;
        $product_info->expired_date =  $request->expired_date;
        $product_info->save();
        $products->save();
        return redirect()->route('cashier-product.index')->with('success', translate_title('Successfully updated', $this->lang));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $products = Products::where('id', $id)->where('store_id', $user->store_id)->first();
        if($products){
            $product_image_small = storage_path('app/public/products/small/'.$products->image);
            if(file_exists($product_image_small)){
                unlink($product_image_small);
            }
            $product_info = $products->product_info;
            if($product_info){
                if($product_info->images){
                    $images = json_decode($product_info->images);
                    foreach ($images as $image){
                        $product_image = storage_path('app/public/products/'.$image);
                        if(file_exists($product_image)){
                            unlink($product_image);
                        }
                    }
                }
                $product_info->delete();
            }
            $products->delete();
        }
        return redirect()->route('cashier-product.index')->with('success', translate_title('Successfully deleted', $this->lang));
    }

    public function deleteProductImage(Request $request){
        $model = Products::where('id', $request->id)->where('store_id', $request->store_id)->first();
        $product_info = $model->product_info;
        $this->productsService->deleteImage($request, $product_info, 'products');
        return response()->json([
            'status'=>true,
            'message'=>'Success'
        ], 200);
    }

    public function getDiscount($percent, $price){
        $discount = (int)$price*(int)$percent/100;
        return $discount;
    }

    public function getProductsByCategory(Request $request)
    {
        $products_category = ProductsCategories::find($request->category_id);
        $data = [];
        $products_data = [];
        $category_ = [];
        $subCategory = [];
        $categories_id = [];

        if ($products_category) {
            if ($products_category->step == 0) {
                $category_ = [
                    'id' => $products_category->id,
                    'name' => $products_category->name,
                ];
                $categories_id[] = $products_category->id;
                foreach($products_category->subcategory as $sub__category){
                    $categories_id[] = $sub__category->id;
                    $subCategory[] = [
                        'id' => $sub__category->id,
                        'name' => $sub__category->name,
                    ];
                }

            } elseif ($products_category->step == 1) {
                $category_ = [
                    'id' => $products_category->category->id,
                    'name' => $products_category->category->name,
                ];

                $subCategory = [
                    'id' => $products_category->id,
                    'name' => $products_category->name,
                ];
                $categories_id = [$products_category->id, $products_category->category->id];
            }

            $products = Products::select('id', 'name', 'amount', 'products_categories_id')->with('discount')->whereIn('products_categories_id', $categories_id)->get();
        } else {
            $subCategory = [];
            $products = [];
            $category_= [];
        }

        foreach ($products as $product) {
            $product_name = $product->name??'';
            $product_amount = $product->amount?' '.$product->amount:'';
            $products_data[] = [
                'id' => $product->id,
                'name' => $product_name.''.$product_amount,
                'products_category_id' => $product->products_categories_id,
                'discount' => $product->discount ? $product->discount->percent : NULL,
                'price_discount' => $product->discount? $product->price - ($product->price / 100 * $product->discount->percent) : NULL,
            ];
        }

        $data[] = [
            'category' => $category_,
            'sub_category' => $subCategory,
            'products' => $products_data,
        ];
        $message = 'Success';

        return response()->json([
            'message'=>$message,
            'status'=>false,
            'data'=>$data
        ], 200);
    }

}
