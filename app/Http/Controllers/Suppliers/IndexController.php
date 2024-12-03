<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public $title;
    public $lang;
    public $current_page = 'user';

    public function __construct()
    {
        $this->title = $this->getTableTitle('Suppliers');
    }

    public function index(){
        $lang = App::getLocale();
        return view('suppliers.index', [
            'title'=>$this->title,
            'lang'=>$lang,
            'current_page'=>$this->current_page
        ]);
    }
}
