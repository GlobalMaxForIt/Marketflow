<?php

namespace App\Service;


use Illuminate\Http\Request;

class ProductsCategoriesService
{
    public function getCategoryData($category, $language, $quantity){
        $category_translation = table_translate_title($category,'products_categories', $language);
        $category_image = $category->image;
        if(!$category_image){
            $category_image = 'no';
        }
        $category_avatar = storage_path('app/public/categories/' . $category_image);
        if (file_exists($category_avatar)) {
            $categoryImage = asset("storage/categories/$category_image");
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
            'quantity'=>$quantity,
        ];
        return $categoryData;
    }
    public function getCategoryShortData($category, $language, $quantity){
        $category_translation = table_translate_title($category,'products_categories', $language);
        $categoryData = [
            'id'=>$category->id,
            'name'=>$category_translation,
            'parent_id'=>$category->parent_id,
            'step'=>$category->step,
            'quantity'=>$quantity,
        ];
        return $categoryData;
    }
    public function getCategoryName($category, $language){
        $category_translation = table_translate_title($category,'products_categories', $language);
        return $category_translation;
    }
}
