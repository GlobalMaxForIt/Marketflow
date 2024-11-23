<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Unit;
use App\Models\UnitTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = Unit::all();
        $datas = [];
        foreach ($units as $unit_){
            foreach (Language::all() as $language) {
                if(!UnitTranslation::where(['lang' => $language->code, 'unit_id' => $unit_->id])->exists()){
                    $datas[] = [
                        'name'=>$unit_->name,
                        'unit_id'=>$unit_->id,
                        'lang' => $language->code
                    ];
                }
            }
        }
        foreach ($datas as $data){
            UnitTranslation::create($data);
        }
    }
}
