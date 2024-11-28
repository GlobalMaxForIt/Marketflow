<?php

namespace App\Service;


use Illuminate\Http\Request;

class AddressService
{
    public function getAddress($address, $language){
        if($address){
            $address_name_ = $address->name;
            if($address->cities){
                $city_translate = table_translate_title($address->cities,'city',$language);
                if($address->cities->region){
                    $region_translate = table_translate_title($address->cities->region,'city',$language);
                    $address_name = $address_name_.' '.$city_translate.' '.$region_translate;
                }else{
                    $address_name = $address_name_.' '.$city_translate;
                }
            }else{
                $address_name = $address_name_;
            }
        }else{
            $address_name = '';
        }
        return $address_name;
    }

}
