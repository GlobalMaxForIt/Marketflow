<?php

namespace Database\Seeders;

use App\Constants;
use App\Models\PersonalInfo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $is_exist_user = User::withTrashed()->where('email', 'admin@btob.com')->first();
        if(!$is_exist_user){
            $personalinfo = [
                'middlename'=>'Admin',
                'gender'=>0,
            ];
            $personal_info = PersonalInfo::create($personalinfo);
            $user = [
                'name'=>'Superadmin',
                'surname'=>'Super',
                'email'=>'admin@btob.com',
                'password'=>Hash::make('btob1234'),
                'role'=>1,
                'personal_info_id'=>$personal_info->id
            ];
            User::create($user);
        }else{
            if(!isset($is_exist_user->deleted_at)){
                echo "Current user is exist status deleted";
            }else{
                echo "Current user is exist status active";
            }
        }
    }
}
