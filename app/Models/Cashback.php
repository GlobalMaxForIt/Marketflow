<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashback extends Model
{
    use HasFactory;

    protected $table = 'cashback';

    public function client(){
        return $this->hasOne(Clients::class, 'id', 'client_id');
    }
    public function cashback_type(){
        return $this->hasOne(CashbackType::class, 'id', 'cashback_type_id');
    }
}
