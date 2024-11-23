<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    use HasFactory;
    protected $table = 'product_info';

    public function unit(){
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }
}
