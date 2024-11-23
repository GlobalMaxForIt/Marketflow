<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sizes extends Model
{
    use HasFactory;

    protected $table = 'sizes';
    protected $fillable = [
        'id',
        'name'
    ];
//
//    public function category(){
//        return $this->hasOne(Category::class, 'id', 'category_id');
//    }

    public function inventory(){
        return $this->hasOne(Inventory::class, 'size_id', 'id');
    }
}
