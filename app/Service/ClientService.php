<?php

namespace App\Service;


use Illuminate\Http\Request;

class ClientService
{

    public function getClientFullInfo($client){
        if(!$client->image){
            $client->image = 'no';
        }
        $avatar_main = storage_path('app/public/clients/' . $client->image);
        if (file_exists($avatar_main)) {
            $client_image = asset("storage/clients/$client->image");
        }else{
            $client_image = asset('icon/no_photo.jpg');
        }
        $clients = [
            'id'=>$client->id,
            'name'=>$client->name,
            'surname'=>$client->surname,
            'middlename'=>$client->middlename,
            'fullname'=>self::getClientFullname($client),
            'phone'=>$client->phone,
            'image'=>$client_image,
            'gender'=>$client->gender,
            'address'=>$client->address,
            'notes'=>$client->notes
        ];
        return $clients;
    }

    public function getClientFullname($client){
        $first_name = $client->name?$client->name.' ':'';
        $last_name = $client->surname?$client->surname.' ':'';
        $middle_name = $client->middlename?$client->middlename:'';
        $client_name = $first_name.''.$last_name.''.$middle_name;
        return $client_name;
    }

}
