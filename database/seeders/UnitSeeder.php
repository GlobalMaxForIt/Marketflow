<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public $units = [
        'Piece (pcs)',
        'Box',
        'Package',
        
        'Kilogram (kg)',
        'Gram (g)',
        'Milligram (mg)',
        'Ton (t)',
        
        'Liter (l)',
        'Milliliter (ml)',
        'Cubic meter (m³)',
        
        'Meter (m)',
        'Centimeter (cm)',
        'Millimeter (mm)',
    ];

    public function run(): void
    {
        $is_exist_unit = Unit::first();
        if(!$is_exist_unit){
            foreach($this->units as $unit_){
                $user = [
                    'name'=>$unit_,
                ];
                Unit::create($user);
            }
        }else{
            if(!isset($is_exist_unit->deleted_at)){
                echo "Unit is exist status deleted";
            }else{
                echo "Unit is exist status active";
            }
        }
    }
}
