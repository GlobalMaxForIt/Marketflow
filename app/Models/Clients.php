<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clients extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clients';

    public function address(){
        return $this->hasOne(Address::class, 'id', 'address_id');
    }
    public function discount(){
        return $this->hasOne(Discount::class, 'client_id', 'id');
    }
    public function sales(){
        return $this->hasmany(Sales::class, 'client_id', 'id');
    }
    public function salesShort(){
        return $this->hasmany(Sales::class, 'client_id', 'id')->select('id', 'total_amount', 'created_at');
    }
}
