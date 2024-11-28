<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use HasFactory;
    protected $table = 'personal_info';

    public function address(){
        return $this->hasOne(Address::class, 'id', 'address_id');
    }
}
