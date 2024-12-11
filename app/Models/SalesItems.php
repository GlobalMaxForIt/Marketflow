<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItems extends Model
{
    use HasFactory;

    protected $table = 'sales_items';

    public function product(){
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
    public function sales(){
        return $this->hasOne(Sales::class, 'id', 'sale_id');
    }

}
