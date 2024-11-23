<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public $title;

    public function __construct()
    {
        $this->title = $this->getTableTitle('Suppliers');
    }

    public function index(){
        return view('suppliers.index', [
            'title'=>$this->title
        ]);
    }
}
