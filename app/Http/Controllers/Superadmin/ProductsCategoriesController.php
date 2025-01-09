<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\Language;
use App\Models\Products;
use App\Models\ProductsCategories;
use App\Models\ProductsCategoriesTranslation;
use App\Service\ProductsCategoriesService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ProductsCategoriesController extends Controller
{
    public $title;
    public $productsCategoriesService;
    public $lang;
    public $current_page = 'category';

    public function __construct(ProductsCategoriesService $productsCategoriesService)
    {
        $this->title = $this->getTableTitle('Products categories');
        $this->productsCategoriesService = $productsCategoriesService;
    }

    public function index()
    {
        $language = App::getLocale();
        $user = Auth::user();
        $products_categories_ = ProductsCategories::where('step', 0)->get();
        $products_sub_categories = [];
        $products_categories = [];
        $products_sub_categories_ = ProductsCategories::where('step', 1)->get();
        foreach($products_sub_categories_ as $products_sub_category){
            $products_sub_categories[] = $this->productsCategoriesService->getCategoryData($products_sub_category, $language, 0);
        }
        foreach($products_categories_ as $products_category){
            $products_categories[] = $this->productsCategoriesService->getCategoryData($products_category, $language, 0);
        }
        return view('superadmin.products_categories.index', [
            'products_sub_categories'=>$products_sub_categories,
            'products_categories'=>$products_categories,
            'title'=>$this->title,
            'lang'=>$language,
            'user'=>$user,
            'notifications'=>$this->getNotification(),
            'current_page'=>$this->current_page
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $products_categories = new ProductsCategories();
        $last_category = ProductsCategories::withTrashed()->select('id')->orderBy('id', 'desc')->first();
        if($last_category){
            $products_categories->id = (int)$last_category->id + 1;
        }
        $products_categories->name = $request->name;
        if($request->image){
            $image = $request->file('image');
            $random = $this->setRandom();
            $product_image_name = $random.''.date('Y-m-dh-i-s').'.'.$image->extension();
            $image->storeAs('public/categories/', $product_image_name);
            $products_categories->image =  $product_image_name;
        }
        $products_categories->parent_id = 0;
        $products_categories->step = 0;
        $products_categories->save();

        foreach (Language::all() as $language) {
            if($request->name){
                $product_category_translations = ProductsCategoriesTranslation::firstOrNew(['lang' => $language->code, 'products_categories_id' => $products_categories->id]);
                $product_category_translations->lang = $language->code;
                $product_category_translations->name = $request->name;
                $product_category_translations->products_categories_id = $products_categories->id;
                $product_category_translations->save();
            }
        }
        return redirect()->route('products-categories.index')->with('success', translate_title('Successfully created', $this->lang));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lang = App::getLocale();
        $user = Auth::user();
        $products_category = ProductsCategories::where('step', 0)->find($id);
        return view('superadmin.products_categories.edit', [
            'products_category'=>$products_category,
            'title'=>$this->title,
            'lang'=>$lang,
            'notifications'=>$this->getNotification(),
            'user'=>$user,
            'current_page'=>$this->current_page
        ]);
    }

    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $products_category = ProductsCategories::where('step', 0)->find($id);
        foreach (Language::all() as $language) {
            if($products_category->name && $request->name && $products_category->name != $request->name){
                $product_categories_translations = ProductsCategoriesTranslation::firstOrNew(['lang' => $language->code, 'products_categories_id' => $products_category->id]);
                $product_categories_translations->lang = $language->code;
                $product_categories_translations->name = $request->name;
                $product_categories_translations->products_categories_id = $products_category->id;
                $product_categories_translations->save();
            }
        }
        $products_category->name = $request->name;
        if($request->image){
            if(!$products_category->image){
                $products_category->image = 'no';
            }
            $old_image = storage_path("app/public/categories/$products_category->image");
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $image = $request->file('image');
            $random = $this->setRandom();
            $product_image_name = $random.''.date('Y-m-dh-i-s').'.'.$image->extension();
            $image->storeAs('public/categories/', $product_image_name);
            $products_category->image =  $product_image_name;
        }
        $products_category->step = 0;
        $products_category->save();
        return redirect()->route('products-categories.index')->with('success', translate_title('Successfully updated', $this->lang));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products_category = ProductsCategories::where('step', 0)->find($id);
        foreach (Language::all() as $language) {
            $product_categories_translations = ProductsCategoriesTranslation::where(['lang' => $language->code, 'products_categories_id' => $products_category->id])->get();
            foreach ($product_categories_translations as $product_category_translation){
                $product_category_translation->delete();
            }
        }
        if($products_category){
            if(!$products_category->subcategory->isEmpty()){
                if(!$products_category->subcategory->isEmpty()){
                    return redirect()->back()->with('error', translate_title('You cannot delete this category because it has subcategories', $this->lang));
                }
            }
            if($products_category->product){
                return redirect()->back()->with('error', translate_title('You cannot delete this category because it has products', $this->lang));
            }
            if(!$products_category->image){
                $products_category->image = 'no';
            }
            $old_image = storage_path("app/public/categories/$products_category->image");
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $products_category->delete();
        }
        return redirect()->route('products-categories.index')->with('success', translate_title('Successfully deleted', $this->lang));
    }

    public function getSubcategory($id)
    {
        $models = ProductsCategories::where('parent_id', $id)->get();
        $data = [];
        $language = App::getLocale();
        foreach($models as $model){
            $data[] = $this->productsCategoriesService->getCategoryData($model, $language, 0);
        }
        if($data){
            return response()->json([
                'status'=>true,
                'data'=>$data
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'data'=>[]
            ]);
        }
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

            $products = Products::select('id', 'name', 'products_categories_id', 'images',  'price', 'description')->with('discount')->whereIn('products_categories_id', $categories_id)->get();
        } else {
            $subCategory = [];
            $products = [];
            $category_= [];
        }
        foreach ($products as $product) {
            $images_array = [];
            if (!is_array($product->images)) {
                $images = json_decode($product->images);
            }
            foreach ($images as $image) {
                if (!$image) {
                    $product_image = 'no';
                } else {
                    $product_image = $image;
                }

                $avatar_main = storage_path('app/public/products/' . $product_image);
                if (file_exists($avatar_main)) {
                    $images_array[] = asset('storage/products/' . $image);
                }
            }

            $products_data[] = [
                'id' => $product->id,
                'name' => $product->name,
                'products_category_id' => $product->products_categories_id,
                'images' => $images_array,
                'description' => $product->description,
                'price' => $product->price,
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
        ]);
    }
}
