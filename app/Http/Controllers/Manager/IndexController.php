<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public $title;

    public function __construct()
    {
        $this->title = $this->getTableTitle('Manager');
    }

    public function index(){
        return view('manager.index', [
            'title'=>$this->title,
        ]);
    }
}
