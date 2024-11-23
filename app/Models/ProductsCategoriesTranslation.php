<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsCategoriesTranslation extends Model
{
    use HasFactory;

    protected $table = "products_categories_translations";
    protected $fillable = [
        'name',
        'products_categories_id',
        'lang'
    ];
}
