<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public $title;
    public $lang;
    public $current_page = 'dashboard';

    public function __construct()
    {
        $this->title = $this->getTableTitle('Cashier');
    }

    public function index(){
        $ordered_orders = 14;
        $lang = App::getLocale();
        $user = Auth::user();
        $performed_orders = 10;
        $cancelled_orders = 2;
        $accepted_orders = 2;
        return view('cashier.index', [
            'title'=>$this->title,
            'ordered_orders'=>$ordered_orders,
            'performed_orders'=>$performed_orders,
            'cancelled_orders'=>$cancelled_orders,
            'accepted_orders'=>$accepted_orders,
            'lang'=>$lang,
            'user'=>$user,
            'notifications'=>$this->getNotification(),
            'current_page'=>$this->current_page
        ]);
    }
}
