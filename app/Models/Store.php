<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $table='stores';

    public function address(){
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    public function organization(){
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }
}
