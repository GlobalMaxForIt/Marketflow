<?php

namespace Database\Seeders;

use App\Models\ProductsCategories;
use Illuminate\Database\Seeder;

class ProductsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public $food_products = [
        "Fresh fruits and vegetables", "Dairy and dairy products", "Bread and baked goods", "Canned goods", "Sweets and confectionery products",
         "Beverages (water, juices, carbonated drinks)",  "Frozen products"
    ];
//    public $electronics = ["Household appliances (refrigerators, washing machines, ovens)", "Mobile phones and accessories", "Computers and laptops",
//            "Televisions and audio-video equipment", "Small home appliances (blenders, toasters, kettles)",
//    ];
    public $personal_care = ["Shampoo and conditioners", "Toothpaste and toothbrushes", "Deodorants and perfumes", "Soap and shower products",
            "Paper products (toilet paper, paper towels)"
    ];
//    public $clothes = ["Men's clothing", "Women's clothing", "Children's clothing", "Accessories (bags, belts, watches)", "Footwear"];
    public $household_items = ["Household tools", "Kitchenware", "Home decorations", "Bedding and curtains", "Furniture",
    ];
    public $sport = ["Sports equipment (balls, rackets)", "Bicycles and scooters", "Fitness equipment", "Camping and travel gear"];
    public $children_products = ["Toys", "Children's clothing", "Baby care products", "Books and educational supplies"];
//    public $automative = ["Car spare parts", "Car accessories", "Motor oils and fluids"];

    public function run(): void
    {
        $categories = [
            [
                'name'=>'Food Products',
                'sub_category'=> $this->food_products
            ],
//            [
//                'name'=>'Home Appliances and Electronics',
//                'sub_category'=> $this->electronics
//            ],
            [
                'name'=>'Hygiene and Personal Care',
                'sub_category'=> $this->personal_care
            ],
//            [
//                'name'=>'Clothing and Fashion',
//                'sub_category'=> $this->clothes
//            ],
            [
                'name'=>'Household Items',
                'sub_category'=> $this->household_items
            ],
            [
                'name'=>'Sports and Leisure',
                'sub_category'=> $this->sport
            ],
            [
                'name'=>'Children\'s Products',
                'sub_category'=> $this->children_products
            ],
//            [
//                'name'=>'Automotive Accessories and Equipment',
//                'sub_category'=> $this->automative
//            ],
        ];
        $category_id = ProductsCategories::withTrashed()->select('id')->orderBy('id', 'desc')->first();
        if(!$category_id){
            $all_categories = [];
            $all_sub_categories = [];
            $category_id_ = $category_id?$category_id->id:0;
            $sub_category_id_ = 0;
            $last_category_id = -1;
            foreach ($categories as $category){
                $category_id_++;
                $all_categories[] = [
                    'id'=>(int)$category_id_,
                    'name'=>$category['name'],
                    'step'=>0, 'parent_id'=>0
                ];
                if($last_category_id < $sub_category_id_){
                    $sub_category_id_ = $category_id_ + count($categories)-1;
                }else{
                    $sub_category_id_ = $last_category_id;
                }
                foreach ($category['sub_category'] as $sub_category){
                    $sub_category_id_++;
                    $last_category_id = $sub_category_id_;
                    $all_sub_categories[] = [
                        'id'=>(int)$sub_category_id_,
                        'name'=>$sub_category,
                        'step'=>1, 'parent_id'=>$category_id_
                    ];
                }
            }
            $all_categories_ = array_merge($all_categories, $all_sub_categories);
            foreach ($all_categories_ as $all_category){
                ProductsCategories::create($all_category);
            }
        }else{
            $category_deleted_at = ProductsCategories::withTrashed()->select('deleted_at')->find($category_id->id);
            if($category_deleted_at->deleted_at){
                echo "Category is exist status deleted";
            }else{
                echo "Category is exist status active";
            }
        }
    }
}
