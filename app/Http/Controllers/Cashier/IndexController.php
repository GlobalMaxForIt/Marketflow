<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public $title;

    public function __construct()
    {
        $this->title = $this->getTableTitle('Cashier');
    }

    public function index(){
        $ordered_orders = 14;
        $performed_orders = 10;
        $cancelled_orders = 2;
        $accepted_orders = 2;
        return view('cashier.index', [
            'title'=>$this->title,
            'ordered_orders'=>$ordered_orders,
            'performed_orders'=>$performed_orders,
            'cancelled_orders'=>$cancelled_orders,
            'accepted_orders'=>$accepted_orders
        ]);
    }
}
