<?php

use App\Models\Translation;
use App\Models\Language;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;


if (!function_exists('default_language')) {
    function default_language()
    {
        return env("DEFAULT_LANGUAGE", 'ru');
    }
}
if (!function_exists('translate_title')) {
    function translate_title($key, $lang)
    {
        $language = app()->getLocale();
        if (!$language) {
            $lang = env('DEFAULT_LANGUAGE','ru');
        }
        $translate = Translation::where('lang_key', $key)
            ->where('lang', $lang)
            ->first();
        if (!$translate){
            foreach (Language::all() as $language) {
                if(!Translation::where('lang_key', $key)->where('lang', $language->code)->exists()){
                    Translation::create([
                        'lang'=>$language->code,
                        'lang_key'=> $key,
                        'lang_value'=>$key
                    ]);
                }
            }
            $data = $key;
        }else{
            $data = $translate->lang_value;
        }

        return $data;

    }
}

if (!function_exists('translate_api')) {
    function translate_api($key, $lang = null)
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        if ($lang === null) {
            $lang = App::getLocale();
        }elseif($user){
            $lang = $user->language;
        }

        $translate = Translation::where('lang_key', $key)
            ->where('lang', $lang)
            ->first();
        if ($translate === null){
            foreach (Language::all() as $language) {
                if(!Translation::where('lang_key', $key)->where('lang', $language->code)->exists()){
                    Translation::create([
                        'lang'=>$language->code,
                        'lang_key'=> $key,
                        'lang_value'=>$key
                    ]);
                }
            }
            $data = $key;
        }else{
            $data = $translate->lang_value;
        }

        return $data;

    }
}
if (!function_exists('table_translate_title')) {
    function table_translate_title($key, $type, $lang)
    {
        switch ($type) {
            case 'product':
                if ($product_translation=DB::table('product_translations')->where('product_id',$key->id)->where('lang',$lang)->first()) {
                    return $product_translation->name;
                }else {
                    return $key->name;
                }
                break;
            case 'product_description':
                if ($product_translation=DB::table('product_description_translations')->where('product_id',$key->id)->where('lang',$lang)->first()) {
                    return $product_translation->name;
                }else {
                    return $key->discription;
                }
                break;
            case 'products_categories':
                if ($color_translations=DB::table('products_categories_translations')->where('products_categories_id',$key->id)->where('lang',$lang)->first()) {
                    return $color_translations->name;
                }else {
                    return $key->name;
                }
                break;
            case 'city':
                if ($city_translations=DB::table('city_translations')->where('city_id',$key->id)->where('lang',$lang)->first()) {
                    return $city_translations->name;
                }else {
                    return $key->name;
                }
                break;
            case 'stuffs_categories':
                if ($stuffs_categories_translations=DB::table('stuffs_categories_translations')->where('stuffs_categories_id',$key->id)->where('lang',$lang)->first()) {
                    return $stuffs_categories_translations->name;
                }else {
                    return $key->name;
                }
                break;

            case 'halls':
                if ($halls_translations=DB::table('halls_translations')->where('hall_id', $key->id)->where('lang',$lang)->first()) {
                    return $halls_translations->name;
                }else {
                    return $key->name;
                }
                break;
            case 'halls_description':
                if ($halls_description_translations=DB::table('halls_description_translations')->where('hall_id',$key->id)->where('lang',$lang)->first()) {
                    return $halls_description_translations->name;
                }else {
                    return $key->discription;
                }
                break;
            default:
                break;
        }

    }
}


