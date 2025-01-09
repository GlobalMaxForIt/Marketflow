<?php

namespace App\Http\Controllers;

use App\Constants;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

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
        $data = translate_title($title, 'ru');
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
    public function getNotification(){
        $current_user = Auth::user();
        $unreadnotifications = $current_user->notifications()->whereNull('read_at')->get();
        $unreadnotifications_quantity = $current_user->notifications()->whereNull('read_at')->count();

        $first_name = $current_user->name?$current_user->name.' ':'';
        $last_name = $current_user->surname?$current_user->surname.' ':'';
        $middle_name = $current_user->middlename?$current_user->middlename:'';
        $current_user_name = $first_name.''.$last_name.''.$middle_name;
        return [
            'current_user'=>$current_user,
            'current_user_name'=>$current_user_name,
            'unreadnotifications'=>$unreadnotifications,
            'unreadnotifications_quantity'=>$unreadnotifications_quantity,
        ];
    }
}
