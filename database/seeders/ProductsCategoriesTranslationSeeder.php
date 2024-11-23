<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\ProductsCategories;
use App\Models\ProductsCategoriesTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsCategoriesTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsCategories = ProductsCategories::all();
        $datas = [];
        foreach ($productsCategories as $product_category){
            foreach (Language::all() as $language) {
                if(!ProductsCategoriesTranslation::where(['lang' => $language->code, 'products_categories_id' => $product_category->id])->exists()){
                    $datas[] = [
                        'name'=>$product_category->name,
                        'products_categories_id'=>$product_category->id,
                        'lang' => $language->code
                    ];
                }
            }
        }
        foreach ($datas as $data){
            ProductsCategoriesTranslation::create($data);
        }
    }
}
