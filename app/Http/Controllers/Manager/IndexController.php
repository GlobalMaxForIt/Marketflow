<?php

namespace App\Http\Controllers\Manager;

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
        $this->title = $this->getTableTitle('Manager');
    }

    public function index(){
        $lang = App::getLocale();
        return view('manager.index', [
            'title'=>$this->title,
            'lang'=>$lang,
            'current_page'=>$this->current_page
        ]);
    }
}
