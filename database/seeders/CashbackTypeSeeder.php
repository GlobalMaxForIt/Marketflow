<?php

namespace Database\Seeders;

use App\Models\CashbackType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashbackTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public $cashback_types = [
        ['iron', 1],
        ['bronze', 2],
        ['silver', 3],
        ['gold', 4],
        ['almaz', 5],
    ];

    public function run(): void
    {
        $is_exist_cashback_type = CashbackType::first();
        if(!$is_exist_cashback_type){
            foreach($this->cashback_types as $cashback_type_){
                $cashbackType = [
                    'name'=>$cashback_type_[0],
                    'percent'=>$cashback_type_[1],
                ];
                CashbackType::create($cashbackType);
            }
        }else{
            if(!isset($is_exist_cashback_type->deleted_at)){
                echo "Cashback type is exist status deleted";
            }else{
                echo "Cashback type is exist status active";
            }
        }
    }
}
