<?php

namespace App\Http\Controllers;

use App\Constants;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function setRandom(){
        $letters = range('a', 'z');
        $random_array = [$letters[rand(0,25)], $letters[rand(0,25)], $letters[rand(0,25)], $letters[rand(0,25)], $letters[rand(0,25)]];
        $random = implode("", $random_array);
        return $random;
    }

    public function getTableTitle($title){
        $data = translate_title($title);
        return $data;
    }

    public function getDiscount($percent, $price){
        $discount = (int)$price*(int)$percent/100;
        return $discount;
    }

    public function error(string $message, int $error_type, array $data = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message ?? 'error occured'
        ], $error_type, [], JSON_INVALID_UTF8_SUBSTITUTE);
    }
    public function success(string $message, int $error_type, array $data = null)
    {
        if ($data) {
            return response()->json([
                'data' => $data ?? NULL,
                'status' => true,
                'message' => $message ?? 'success'
            ], 200, [], JSON_INVALID_UTF8_SUBSTITUTE); // $error_type
        }
        return response()->json([
            'status' => true,
            'message' => $message ?? 'success'
        ], 200, [], JSON_INVALID_UTF8_SUBSTITUTE); // $error_type

    }

}
