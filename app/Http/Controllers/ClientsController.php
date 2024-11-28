<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\Address;
use App\Models\Clients;
use App\Service\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ClientsController extends Controller
{
    public $title;
    public $clientService;
    public $lang;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
        $this->title = $this->getTableTitle('Clients');
    }

    public function index()
    {
        $clients_ = Clients::all();
        $clients = [];
        $lang = App::getLocale();
        foreach($clients_ as $client){
            $clients[] = $this->clientService->getClientFullInfo($client);
        }
        return view('clients.index', [
            'clients'=>$clients,
            'title'=>$this->title,
            'lang'=>$lang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->district && $request->region && $request->address){
            $address = new Address();
            if($request->district){
                $address->city_id = $request->district;
            }elseif($request->region){
                $address->city_id = $request->region;
            }
            $address->name = $request->address;
            $address->save();
        }
        $clients = new Clients();
        $clients->name = $request->name;
        $clients->surname = $request->surname;
        $clients->middlename = $request->middlename;
        $clients->phone = $request->phone;
        $clients->email = $request->email;
        $clients->gender = $request->gender;
        if(isset($address)){
            $clients->address_id = $address->id;
        }
        $clients->notes = $request->notes;
        if($request->image){
            $image = $request->file('image');
            $random = $this->setRandom();
            $product_image_name = $random.''.date('Y-m-dh-i-s').'.'.$image->extension();
            $image->storeAs('public/clients/', $product_image_name);
            $clients->image =  $product_image_name;
        }
        $clients->save();
        return redirect()->route('clients.index')->with('success', translate_title('Successfully created', $this->lang));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lang = App::getLocale();
        $client = Clients::find($id);
        return view('clients.edit', [
            'client'=>$client,
            'title'=>$this->title,
            'lang'=>$lang
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
        $clients = Clients::find($id);
        if($request->district && $request->region && $request->address){
            $address = new Address();
            if($request->district){
                $address->city_id = $request->district;
            }elseif($request->region){
                $address->city_id = $request->region;
            }
            $address->name = $request->address;
            $address->save();
        }
        $clients->name = $request->address;
        $clients->surname = $request->surname;
        $clients->phone = $request->phone;
        $clients->email = $request->email;
        $clients->gender = $request->gender;
        if(isset($address)){
            $clients->address_id = $address->id;
        }
        $clients->notes = $request->notes;
        if($request->image){
            if(!$clients->image){
                $clients->image = 'no';
            }
            $old_image = storage_path("app/public/clients/$clients->image");
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $image = $request->file('image');
            $random = $this->setRandom();
            $product_image_name = $random.''.date('Y-m-dh-i-s').'.'.$image->extension();
            $image->storeAs('public/clients/', $product_image_name);
            $clients->image =  $product_image_name;
        }
        if(isset($address)){
            $clients->address_id = $address->id;
        }
        $clients->save();
        return redirect()->route('clients.index')->with('success', translate_title('Successfully updated', $this->lang));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clients = Clients::find($id);
        if(!$clients->image){
            $clients->image = 'no';
        }
        $old_image = storage_path("app/public/clients/$clients->image");
        if(file_exists($old_image)){
            unlink($old_image);
        }
        $clients->delete();
        return redirect()->route('clients.index')->with('success', translate_title('Successfully deleted', $this->lang));
    }

    public function ajaxStore(Request $request)
    {
        if($request->client_male == 1){
            $gender = Constants::MALE;
        }elseif($request->client_female == 1){
            $gender = Constants::FEMALE;
        }
        if($request->client_district && $request->client_region && $request->client_address){
            $address = new Address();
            if($request->client_district){
                $address->city_id = $request->client_district;
            }elseif($request->client_region){
                $address->city_id = $request->client_region;
            }
            $address->name = $request->client_address;
            $address->save();
        }

        $clients = new Clients();
        $clients->name = $request->client_name;
        $clients->surname = $request->client_surname;
        $clients->middlename = $request->client_middlename;
        $clients->phone = $request->client_phone;
        $clients->email = $request->client_email;
        $clients->gender = $gender;
        if(isset($address)){
            $clients->address_id = $address->id;
        }
        $clients->notes = $request->client_notes;
        if($request->client_image_input){
            $image = $request->file('client_image_input');
            $random = $this->setRandom();
            $product_image_name = $random.''.date('Y-m-dh-i-s').'.'.$image->extension();
            $image->storeAs('public/clients/', $product_image_name);
            $clients->image =  $product_image_name;
        }
        $clients->save();
        $data = [
            'status'=>200,
            'message'=>'success',
            'client_id'=>$clients->id
        ];
        return response()->json($data);
    }

    public function getClientById($id)
    {
        $client = Clients::find($id);
        $client_info = [];
        $discount = 0;
        $discount_percent = 0;
        if($client){
            $client_info = $this->clientService->getClientFullInfo($client);
            if($client->discount){
                $discount = (100-(int)$client->discount->percent)/100;
                $discount_percent = $client->discount->percent;
            }
        }

        $data = [
            'status'=>200,
            'message'=>'success',
            'client'=>$client_info,
            'discount'=>$discount,
            'discount_percent'=>$discount_percent
        ];
        return response()->json($data);
    }
}
