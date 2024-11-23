<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $table='organizations';

    public function address(){
        return $this->hasOne(Address::class, 'id', 'address_id');
    }
}
