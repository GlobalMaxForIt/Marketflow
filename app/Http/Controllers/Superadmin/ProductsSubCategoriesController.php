<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\ProductsCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ProductsSubCategoriesController extends Controller
{
    public $title;
    public $lang;
    public $current_page = 'category';

    public function __construct()
    {
        $this->title = $this->getTableTitle('Products categories');
    }

    public function index()
    {

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
        $products_categories->parent_id = $request->products_categories_id;
        $products_categories->step = 1;
        $products_categories->save();
        return redirect()->route('products-categories.index')->with('success', translate_title('Successfully created', $this->lang));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products_sub_category = ProductsCategories::where('step', 1)->find($id);
        $products_categories = ProductsCategories::where('step', 0)->get();
        $lang = App::getLocale();
        $user = Auth::user();
        return view('superadmin.products_sub_categories.edit', [
            'products_sub_category'=>$products_sub_category,
            'products_categories'=>$products_categories,
            'title'=>$this->title,
            'lang'=>$lang,
            'user'=>$user,
            'notifications'=>$this->getNotification(),
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
        $products_category = ProductsCategories::find($id);
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
        $products_category->parent_id = $request->products_categories_id;
        $products_category->step = 1;
        $products_category->save();
        return redirect()->route('products-categories.index')->with('success', translate_title('Successfully updated', $this->lang));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products_category = ProductsCategories::find($id);
        if($products_category){
            if($products_category->product) {
                return redirect()->back()->with('error', translate_title('You cannot delete this category because here is product in this category.', $this->lang));
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
}
