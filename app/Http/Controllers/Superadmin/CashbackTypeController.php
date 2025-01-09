<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\CashbackType;
use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use function redirect;
use function translate_title;
use function view;

class CashbackTypeController extends Controller
{
    public $title;
    public $lang;
    public $current_page = 'cashback_type';

    public function __construct()
    {
        $this->title = $this->getTableTitle('Cashback type');
    }

    public function index()
    {
        $cashback_type = CashbackType::all();
        $lang = App::getLocale();
        return view('superadmin.cashback-type.index', [
            'title'=>$this->title,
            'lang'=>$lang,
            'cashback_type'=>$cashback_type,
            'notifications'=>$this->getNotification(),
            'current_page'=>$this->current_page
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cashback_type = new CashbackType();
        $cashback_type->name = $request->name;
        $cashback_type->percent = $request->percent;
        $cashback_type->save();
        return redirect()->route('cashback-type.index')->with('success', translate_title('Successfully created', $this->lang));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lang = App::getLocale();
        $cashback_type = CashbackType::find($id);
        return view('superadmin.cashback-type.edit', [
            'cashback_type'=>$cashback_type,
            'title'=>$this->title,
            'lang'=>$lang,
            'notifications'=>$this->getNotification(),
            'current_page'=>$this->current_page
        ]);
    }

    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cashback_type = CashbackType::find($id);
        $cashback_type->name = $request->name;
        $cashback_type->percent = $request->percent;
        $cashback_type->save();
        return redirect()->route('cashback-type.index')->with('success', translate_title('Successfully updated', $this->lang));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cashback_type = CashbackType::find($id);
        $cashback_type->delete();
        return redirect()->route('cashback-type.index')->with('success', translate_title('Successfully deleted', $this->lang));
    }
}
