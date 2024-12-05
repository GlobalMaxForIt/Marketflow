<?php

namespace App\Service;


use Illuminate\Http\Request;
use App\Models\ProductsCategories;
use App\Models\Products;
use Intervention\Image\Facades\Image;

class ProductsService
{
    public function deleteImage($request, $model, $images_directory){
        if($model->images && !is_array($model->images)){
            $product_images_base = json_decode($model->images);
        }else{
            $product_images_base = [];
        }
        if(is_array($product_images_base)){
            if(isset($request->product_name)){
                $selected_product_key = array_search($request->product_name, $product_images_base);

                if(!$request->product_name){
                    $request->product_name = 'no';
                }
                $product_main = storage_path("app/public/$images_directory/".$request->product_name);

                if(file_exists($product_main)){
                    unlink($product_main);
                }
                unset($product_images_base[$selected_product_key]);
            }
            $model->images = json_encode(array_values($product_images_base));
            $model->save();
        }else{
            return [];
        }
    }

    public function getAllProducts(Request $request){
        $products_categories = ProductsCategories::where('step', 0)->get();
        $category_data = [];
        $language = $request->header('language');
        foreach($products_categories as $category){
            $category_translation = table_translate_title($category,'products_categories', $language);
            $category_image = $category->image;
            if(!$category_image){
                $category_image = 'no';
            }
            $category_avatar = storage_path('app/public/categories/' . $category_image);
            if (file_exists($category_avatar)) {
                $categoryImage = asset("storage/categories/$category_avatar");
            }else{
                $categoryImage = 'no';
            }
            $categoryData = [
                'id'=>$category->id,
                'name'=>$category_translation,
                'image'=>$categoryImage,
                'parent_id'=>$category->parent_id,
                'step'=>$category->step,
                'created_at'=>$category->created_at,
                'updated_at'=>$category->updated_at,
            ];
            $subcategory_data = [];
            $sub_categories = $category->subcategory;
            foreach($sub_categories as $sub_category){
                $sub_category_translation = table_translate_title($sub_category,'products_categories', $language);
                $sub_category_image = $sub_category->image;
                if(!$sub_category_image){
                    $sub_category_image = 'no';
                }
                $sub_category_avatar = storage_path('app/public/categories/' . $sub_category_image);
                if(file_exists($sub_category_avatar)){
                    $subCategoryImage = asset("storage/categories/$sub_category_avatar");
                }else{
                    $subCategoryImage = 'no';
                }
                $subCategoryData = [
                    'id'=>$category->id,
                    'name'=>$sub_category_translation,
                    'image'=>$subCategoryImage,
                    'parent_id'=>$category->parent_id,
                    'step'=>$category->step,
                    'created_at'=>$category->created_at,
                    'updated_at'=>$category->updated_at,
                ];
                $products_ = \App\Service\Products::orderBy('created_at', 'desc')->where('products_categories_id', $sub_category->id)->get();
                $products = [];
                foreach ($products_ as $product) {
                    $images = [];
                    if ($product->images) {
                        $images_ = json_decode($product->images);
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
                    if($product->discount){
                        if($product->discount->percent&& $product->price){
                            $discount = $this->getDiscount($product->discount->percent, $product->price);
                        }else{
                            $discount = 0;
                        }
                    }else{
                        $discount = 0;
                    }
                    $product_translation = table_translate_title($product,'product', $language);
                    $array_products=[
                        'id'=>$product->id,
                        'name'=>$product->name,
                        'amount'=>$product_translation,
                        'price'=>number_format((int)$product->price, 0, '', ' '),
                        'discount'=>number_format($discount, 0, '', ' '),
                        'last_price'=>number_format((int)$product->price - $discount, 0, '', ' '),
                        'description'=>$product->description,
                        'barcode'=>$product->barcode,
                        'status'=>$product->status,
                        'images'=>$images,
                        'created_at'=>$product->created_at,
                        'updated_at'=>$product->updated_at,
                        'deleted_at'=>$product->deleted_at,
                    ];
                    $products[] = $array_products;
                }
                $subcategory_data[] = [
                    'sub_category'=>$subCategoryData,
                    'products'=>$products,
                    'products_quantity'=>count($products)
                ];
            }
            $category_data[] = [
                'category'=>$categoryData,
                'sub_categories'=>$subcategory_data,
                'sub_categories_quantity'=>count($subcategory_data)
            ];
        }
        $allProductsData = [
            'categories'=>$category_data,
            'categories_quantity'=>count($category_data),
        ];
        return $allProductsData;
    }

    public function getProducts($products_){
        $allProducts = [];
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
            $product_small_image = storage_path('app/public/products/small/'.$product->image);
            if(file_exists($product_small_image)){
                $small_image = asset('storage/products/small/'.$product->image);
            }else{
                $small_image = asset('icon/no_photo.jpg');
            }

            $array_products = [
                'id'=>$product->id,
                'products_categories'=>$product->products_categories,
                'short_name'=>$this->truncateString($product->name),
                'name'=>$product->name,
                'amount'=>$product->amount,
                'price'=>number_format((int)$product->price, 0, '', ' '),
                'discount'=>number_format($discount, 0, '', ' '),
                'discount_percent'=>$discount_percent,
                'last_price'=>number_format((int)$product->price - $discount, 0, '', ' '),
                'barcode'=>$product->barcode,
                'image'=>$small_image,
                'stock'=>$product->stock,
            ];
            $allProducts[] = $array_products;
        }
        return $allProducts;
    }

    public function getDiscount($percent, $price){
        $discount = (int)$price*(int)$percent/100;
        return $discount;
    }

    function truncateString($string, $length = 14, $suffix = '...') {
        if (strlen($string) > $length) {
            return substr($string, 0, $length) . $suffix;
        }
        return $string;
    }

}
