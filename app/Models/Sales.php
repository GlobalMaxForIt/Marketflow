<?php

namespace App\Models;

use App\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';

    public function salesItems(){
        return $this->hasMany(SalesItems::class, 'sale_id', 'id');
    }

    public function client(){
        return $this->hasOne(Clients::class, 'id', 'client_id');
    }

    public function store(){
        return $this->hasOne(Store::class, 'id', 'store_id');
    }

    public function cashier(){
        return $this->hasOne(User::class, 'id', 'cashier_id')->where('status', Constants::CASHIER);
    }

    public function salesPayment(){
        return $this->hasOne(SalesPayments::class, 'sale_id', 'id');
    }

    public function salesReport(){
        return $this->hasOne(SalesReports::class, 'sale_id', 'id');
    }

    public function giftCard(){
        return $this->hasOne(giftCard::class, 'id', 'sale_id');
    }

}
