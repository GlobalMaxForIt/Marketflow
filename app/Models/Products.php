<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function products_categories(){
        return $this->hasOne(ProductsCategories::class, 'id', 'products_categories_id')->where('step', 1);
    }

    public function unit(){
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }

    public function store(){
        return $this->hasOne(Store::class, 'id', 'store_id');
    }

    public function company(){
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function product_info(){
        return $this->hasOne(ProductInfo::class, 'product_id', 'id');
    }

    public function discount()
    {
        return $this->hasOne(Discount::class, 'product_id','id')->where('start_date', '<=', date('Y-m-d H:i:s'))->where('end_date', '>=', date('Y-m-d H:i:s'));
    }

    public function discount_withouth_expire()
    {
        return $this->hasOne(Discount::class, 'product_id','id')->orderBy('end_date', 'desc');
    }
}
