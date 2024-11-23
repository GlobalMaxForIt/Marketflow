<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\ClientService;
use Illuminate\Http\Request;
use App\Constants;

class IndexController extends Controller
{
    public $title;

    public function __construct()
    {
        $this->title = $this->getTableTitle('Admin');
    }

    public function index(){
        $ordered_orders = 14;
        $performed_orders = 10;
        $cancelled_orders = 2;
        $accepted_orders = 2;
        return view('admin.index', [
            'title'=>$this->title,
            'ordered_orders'=>$ordered_orders,
            'performed_orders'=>$performed_orders,
            'cancelled_orders'=>$cancelled_orders,
            'accepted_orders'=>$accepted_orders
        ]);
    }

    public function table(){
        return view('admin.table', [
            'title'=>$this->title,
        ]);
    }
}
