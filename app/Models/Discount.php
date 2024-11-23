<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    public $fillable = [
      'id',
      'percent',
      'product_id',
      'type',
      'start_date',
      'end_date',
    ];

    public function product(){
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
    public function client(){
        return $this->hasOne(Clients::class, 'id', 'client_id');
    }
    public function category(){
        return $this->hasOne(ProductsCategories::class, 'id', 'products_categories_id')->where('step', 0);
    }
    public function subCategory(){
        return $this->hasOne(ProductsCategories::class, 'id', 'products_categories_id')->where('step', 1);
    }
}
