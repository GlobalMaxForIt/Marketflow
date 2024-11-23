<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';

    public function inventory(){
        return $this->hasOne(Inventory::class, 'color_id', 'id');
    }
}
