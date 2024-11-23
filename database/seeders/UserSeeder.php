<?php

namespace Database\Seeders;

use App\Constants;
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
            $user = [
                'name'=>'Superadmin',
                'surname'=>'Super',
                'middlename'=>'Admin',
                'gender'=>0,
                'email'=>'admin@btob.com',
                'password'=>Hash::make('btob1234'),
                'role'=>1
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
