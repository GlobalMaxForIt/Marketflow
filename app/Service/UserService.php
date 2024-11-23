<?php

namespace App\Service;


use Illuminate\Http\Request;

class UserService
{
    public function getOld($user){
        $year_old = 0;
        if($user->birth_date){
            $now_time = strtotime('now');
            $birth_time = strtotime($user->birth_date);
            $month = date('m', ($now_time));
            $day = date('d', ($now_time));
            $birth_month = date('m', ($birth_time));
            $birth_date = date('d', ($birth_time));
            $year = date('Y', ($now_time));
            $birth_year = date('Y', ($birth_time));
            $year_old = 0;
            if($year > $birth_year){
                $year_old = $year - $birth_year - 1;
                if($month > $birth_month){
                    $year_old = $year_old +1;
                }elseif($month == $birth_month){
                    if($day >= $birth_date){
                        $year_old = $year_old +1;
                    }
                }
            }
        }
        return $year_old;
    }
}
