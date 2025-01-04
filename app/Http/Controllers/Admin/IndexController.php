<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\ClientService;
use Illuminate\Http\Request;
use App\Constants;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public $title;
    public $lang;
    public $current_page = 'dashboard';

    public function __construct()
    {
        $this->title = $this->getTableTitle('Admin');
    }

    public function index(){
        $lang = App::getLocale();
        $user = Auth::user();
        $ordered_orders = 14;
        $performed_orders = 10;
        $cancelled_orders = 2;
        $accepted_orders = 2;
        return view('admin.index', [
            'title'=>$this->title,
            'ordered_orders'=>$ordered_orders,
            'performed_orders'=>$performed_orders,
            'cancelled_orders'=>$cancelled_orders,
            'accepted_orders'=>$accepted_orders,
            'lang'=>$lang,
            'user'=>$user,
            'current_page'=>$this->current_page
        ]);
    }

    public function table(){
        $user = Auth::user();
        return view('admin.table', [
            'title'=>$this->title,
            'lang'=>$this->lang,
            'user'=>$user,
        ]);
    }
}
