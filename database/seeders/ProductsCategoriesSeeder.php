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
        "Fruits and vegetables",
        "Dairy and bakery products",
        "Canned and frozen foods",
        "Sweets, snacks, and desserts",
        "Beverages and alcoholic drinks",
        "Meat, seafood, and ready-to-eat meals",
        "Grains, cereals, and spices",
        "Organic and international foods",
        "Baby food and ice cream",
    ];
    public $beverages = [
        "Non-Alcoholic Drinks (Juices, Soft Drinks, Water, Sports Drinks)",
        "Alcoholic Beverages (Beer, Wine, Spirits, Cocktails)",
        "Hot Drinks (Tea, Coffee, Hot Chocolate)",
        "Energy Drinks (Energy Beverages, Vitamin Drinks)",
        "Dairy Beverages (Milk, Yogurt Drinks, Milkshakes)",
        "Smoothies & Shakes (Fruit Smoothies, Protein Shakes, Meal Replacement Drinks)",
        "Flavored Water (Infused Water, Sparkling Water)",
        "Functional Beverages (Herbal Teas, Detox Drinks, Probiotics)",
        "Health Drinks (Nutritional Drinks, Weight Loss, Herbal Beverages)",
        "Soda & Carbonated Drinks (Colas, Lemonades, Fizzy Drinks, Sparkling Beverages)"
    ];

    public $electronics = [
        "Household and small appliances",
        "Mobile phones and accessories",
        "Computers, laptops, and storage devices",
        "Televisions, AV equipment, and audio devices",
        "Gaming consoles and drones",
        "Cameras, photography gear, and wearable devices",
        "Smart home and office electronics",
        "Printers, scanners, and power solutions",
        "Electric vehicles and car electronics",
        "Batteries and accessories",
        "E-readers and tablets"
    ];

    public $personal_care = [
        "Hair and oral care",
        "Skin and body care",
        "Men's and women's grooming products",
        "Baby and kids' care",
        "Hygiene and travel-sized products",
        "Fragrances and makeup",
        "Nail and foot care",
        "Bath accessories and lotions",
        "Deodorants, perfumes, and fragrances"
    ];


    public $clothes = [
        "Men's Clothing (Tops, Bottoms, Outerwear, Suits)",
        "Women's Clothing (Tops, Bottoms, Dresses, Outerwear)",
        "Children's Clothing (Boys, Girls, Baby Wear)",
        "Footwear (Shoes, Boots, Sandals, Sneakers)",
        "Accessories (Bags, Belts, Watches, Jewelry)",
        "Lingerie and Sleepwear (Bras, Pajamas)",
        "Sportswear and Activewear (Athletic, Yoga Wear)",
        "Outerwear and Jackets (Coats, Jackets)",
        "Sustainable Fashion (Eco-friendly, Fair Trade)",
        "Maternity Clothing (Tops, Pants, Dresses)"
    ];
    public $household_items = [
        "Cleaning Products (Detergents, Cleaners, Sponges)",
        "Kitchenware (Cookware, Utensils, Storage)",
        "Furniture (Living Room, Bedroom, Office)",
        "Bedding and Linens (Bed Sheets, Towels, Pillows)",
        "Home Decor (Rugs, Curtains, Wall Art)",
        "Appliances (Vacuum Cleaners, Air Conditioners, Fans)",
        "Lighting (Lamps, Ceiling Lights, Bulbs)",
        "Gardening and Outdoor (Tools, Plants, Furniture)",
        "Storage Solutions (Bins, Shelves, Organizers)",
        "Safety and Security (Alarms, Locks, Fire Extinguishers)"
    ];
    public $sport_items = [
        "Fitness Equipment (Dumbbells, Treadmills, Resistance Bands)",
        "Sports Apparel (Activewear, Shoes, Socks)",
        "Outdoor Sports (Camping, Hiking, Cycling)",
        "Team Sports (Football, Basketball, Volleyball)",
        "Water Sports (Swimming, Surfing, Diving)",
        "Winter Sports (Skiing, Snowboarding, Ice Skating)",
        "Racket Sports (Tennis, Badminton, Table Tennis)",
        "Yoga and Pilates (Mats, Blocks, Straps)",
        "Martial Arts (Kits, Gloves, Protective Gear)",
        "Sports Accessories (Bags, Watches, Hydration)"
    ];
    public $children_products = [
        "Clothing (Tops, Bottoms, Outerwear, Sleepwear)",
        "Toys (Educational, Plush, Puzzles, Action Figures)",
        "Baby Gear (Strollers, Car Seats, High Chairs)",
        "Feeding (Bottles, Breast Pumps, Baby Food)",
        "Nursery Furniture (Cribs, Changing Tables, Rocking Chairs)",
        "Health and Safety (Thermometers, Baby Monitors, Safety Gates)",
        "Books and Learning (Storybooks, Activity Books, Flashcards)",
        "Outdoor Toys and Play (Bikes, Scooters, Playsets)",
        "School Supplies (Backpacks, Stationery, Art Supplies)",
        "Diapers and Baby Care (Diapers, Wipes, Creams)"
    ];

    public $automotive = [
        "Car Parts (Engines, Brakes, Batteries, Suspension)",
        "Car Accessories (Floor Mats, Seat Covers, Sun Shades)",
        "Tires and Wheels (Tires, Rims, Tire Accessories)",
        "Tools and Equipment (Jacks, Wrenches, Compressors)",
        "Car Care (Cleaners, Polishes, Wax, Detailing Kits)",
        "Lighting (Headlights, Taillights, Fog Lights)",
        "Safety and Security (Car Alarms, Dash Cams, Locks)",
        "Performance Parts (Turbochargers, Exhaust Systems, Tuners)",
        "Interior Accessories (Air Fresheners, Organizers, Dash Covers)",
        "Motorcycles and ATV (Helmets, Gloves, Riding Gear)"
    ];

    public $others = [
        "Books and Stationery (Books, Notebooks, Pens, Office Supplies)",
        "Health and Wellness (Supplements, Vitamins, First Aid)",
        "Pets (Pet Food, Toys, Grooming Products)",
        "Travel and Luggage (Bags, Suitcases, Travel Accessories)",
        "Electronics Accessories (Chargers, Cables, Cases)",
        "Hobbies and Crafts (Art Supplies, DIY Kits, Musical Instruments)",
        "Garden and Outdoor (Furniture, Tools, Plants, Decor)",
        "Food and Beverage (Gourmet, Snacks, Beverages)",
        "Gifts and Novelties (Gift Cards, Souvenirs, Seasonal Gifts)"
    ];

    public function run(): void
    {
        $categories = [
            [
                'name'=>'Food products',
                'sub_category'=> $this->food_products
            ],
            [
                'name'=>'Beverages',
                'sub_category'=> $this->beverages
            ],
            [
                'name'=>'Electronics',
                'sub_category'=> $this->electronics
            ],
            [
                'name'=>'Personal Care',
                'sub_category'=> $this->personal_care
            ],
            [
                'name'=>'Clothing',
                'sub_category'=> $this->clothes
            ],
            [
                'name'=>'Household Items',
                'sub_category'=> $this->household_items
            ],
            [
                'name'=>'Sports',
                'sub_category'=> $this->sport_items
            ],
            [
                'name'=>'Children\'s Products',
                'sub_category'=> $this->children_products
            ],
            [
                'name'=>'Automotive Accessories and Equipment',
                'sub_category'=> $this->automotive
            ],
            [
                'name'=>'The others',
                'sub_category'=> $this->others
            ],
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
