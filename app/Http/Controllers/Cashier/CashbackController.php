<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Cashback;
use App\Models\CashbackType;
use App\Models\Clients;
use App\Models\Discount;
use App\Service\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CashbackController extends Controller
{
    public $title;
    public $clientService;
    public $lang;
    public $current_page = 'cashback';

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
        $this->title = $this->getTableTitle('Cashback');
    }

    public function index()
    {
        $cashbacks = Cashback::all();
        $all_cashbacks = [];
        foreach($cashbacks as $cashback){
            $client_full_name = '';
            if($cashback->client){
                $client_full_name = $this->clientService->getClientFullname($cashback->client);
            }
            $cashback_types_text = '';
            if($cashback->cashback_type){
                $cashback_types_text = $cashback->cashback_type->name.' '.$cashback->cashback_type->percent.' %';
            }
            $all_cashbacks[] = [
                'id'=>$cashback->id,
                'client'=>$client_full_name,
                'cashback_type'=>$cashback_types_text,
                'all_sum'=>number_format((int)$cashback->all_sum, 0, '', ' '),
                'taken_sum'=>number_format((int)$cashback->taken_sum, 0, '', ' '),
                'left_sum'=>number_format((int)$cashback->left_sum, 0, '', ' '),
                'client_expenses'=>number_format((int)$cashback->client_expenses, 0, '', ' '),
            ];
        }
        $cashback_types = CashbackType::all();
        $cashback_clients_id = Cashback::distinct('client_id')->whereNotNull('client_id')->pluck('client_id');
        $clients_for_discount = [];
        $clients__ = Clients::whereNotIn('id', $cashback_clients_id)->get();
        foreach($clients__ as $client__){
            $clients_for_discount[] = $this->clientService->getClientFullInfo($client__);
        }
        $lang = App::getLocale();
        return view('cashier.cashback.index', [
            'title'=>$this->title,
            'lang'=>$lang,
            'all_cashbacks'=>$all_cashbacks,
            'clients_for_discount'=>$clients_for_discount,
            'cashback_types'=>$cashback_types,
            'current_page'=>$this->current_page,
            'notifications'=>$this->getNotification()
        ]);
    }

    public function store(Request $request){
        $has_cashback = Cashback::where('client_id', $request->client_id)->first();
        if(!$has_cashback){
            $cashback = new Cashback();
            $cashback->client_id = $request->client_id;
            $cashback->cashback_type_id = $request->cashback_type_id;
            $cashback->save();
            return redirect()->route('cashback.index')->with('success', translate_title('Successfully created', $this->lang));
        }else{
            return redirect()->route('cashback.index')->with('error', translate_title('This user has cashback type', $this->lang));
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cashback = Cashback::find($id);
        if($cashback){
            $cashback->delete();
        }
        return redirect()->route('cashback.index')->with('success', translate_title('Successfully deleted', $this->lang));
    }
}
