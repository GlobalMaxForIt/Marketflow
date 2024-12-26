<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnModel extends Model
{
    use HasFactory;

    protected $table = 'returns';

    public function sales(){
        return $this->hasOne(Sales::class, 'id', 'sale_id');
    }
    public function salesItem(){
        return $this->hasOne(SalesItems::class, 'id', 'sale_item_id');
    }
}
