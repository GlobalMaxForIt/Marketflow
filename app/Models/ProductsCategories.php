<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsCategories extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products_categories';

    public function subcategory(){
        return $this->hasmany(ProductsCategories::class, 'parent_id', 'id')->where('step', 1);
    }
    public function product(){
        return $this->hasOne(Products::class, 'products_categories_id','id');
    }
    public function category(){
        return $this->hasOne(ProductsCategories::class, 'id','parent_id')->where('step', 0);
    }
    public function unit(){
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }
}
