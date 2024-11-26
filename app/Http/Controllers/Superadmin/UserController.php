<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\Address;
use App\Models\Company;
use App\Models\Organization;
use App\Models\Store;
use App\Models\User;
use App\Service\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $title;
    public $user_service;
    public $lang;

    public function __construct(UserService $user_service)
    {
        $this->title = $this->getTableTitle('Users');
        $this->user_service = $user_service;
    }

    public function index()
    {
        $users_ = User::all();
        $users = [];
        $lang = App::getLocale();
        $roles = [
            ['value'=>1, 'name'=>'superadmin'],
            ['value'=>2, 'name'=>'admin'],
            ['value'=>3, 'name'=>'manager'],
            ['value'=>4, 'name'=>'cashier'],
            ['value'=>5, 'name'=>'suppliers']
        ];
        foreach($users_ as $user) {
            if ($user['gender'] == \App\Constants::MALE) {
                $gender = translate_title('Male', $this->lang);
            }elseif ($user['gender'] == \App\Constants::FEMALE){
                $gender = translate_title('Female', $this->lang);
            }

            if ($user['status'] == \App\Constants::NOT_ACTIVE) {
                $status = translate_title('Not active', $this->lang);
            }elseif($user['status'] == \App\Constants::ACTIVE){
                $status = translate_title('Active', $this->lang);
            }
            switch($user['role']){
                case \App\Constants::SUPERADMIN:
                    $role = translate_title('Superadmin', $this->lang);
                    break;
                case \App\Constants::ADMIN:
                    $role = translate_title('Admin', $this->lang);
                    break;
                case \App\Constants::MANAGER:
                    $role = translate_title('Manager', $this->lang);
                    break;
                case \App\Constants::CASHIER:
                    $role = translate_title('Cashier', $this->lang);
                    break;
                case \App\Constants::SUPPLIERS:
                    $role = translate_title('Suppliers', $this->lang);
                    break;
                default:
                    $role = '';
            }
            $users[] = [
                'id'=>$user->id,
                'name'=>$user->name,
                'surname'=>$user->surname,
                'middlename'=>$user->middlename,
                'phone'=>$user->phone,
                'old'=>$this->user_service->getOld($user),
                'image'=>$user->image,
                'gender'=>$gender,
                'role'=>$role,
                'email'=>$user->email,
                'status'=>$status,
                'address'=>$user->address,
                'passport'=>$user->passport,
                'company'=>$user->company_id,
                'organization'=>$user->organization_id,
            ];
        }

        $companies_ = Company::all();
        $companies = [];
        foreach($companies_ as $company) {
            $companies[] = [
                'id'=>$company->id,
                'name'=>$company->name
            ];
        }

        $organizations_ = Organization::all();
        $organizations = [];
        foreach($organizations_ as $organization) {
            $organizations[] = [
                'id'=>$organization->id,
                'name'=>$organization->name
            ];
        }

//        $stores_ = Store::all();
//        $organizations = [];
//        foreach($organizations_ as $organization) {
//            $organizations = [
//                'id'=>$organization->id,
//                'name'=>$organization->name,
//                'address'=>$organization->address_id
//            ];
//        }
        return view('superadmin.stuffs.index', [
            'users'=>$users,
            'companies'=>$companies,
            'organizations'=>$organizations,
            'title'=>$this->title,
            'roles'=>$roles,
            'lang'=>$lang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $address = new Address();
        if($request->district){
            $address->city_id = $request->district;
        }elseif($request->region){
            $address->city_id = $request->region;
        }
        if($request->new_password && $request->new_password != $request->password_confirmation){
            return redirect()->back()->with('error', translate_title('Your new password confirmation is incorrect', $this->lang));
        }
        if($request->new_password && !$request->email){
            return redirect()->back()->with('error', translate_title('Your don\'t have email', $this->lang));
        }
        $address->name = $request->address;
        $address->save();
        $users = new User();
        $users->name = $request->name;
        $users->surname = $request->surname;
        $users->middlename = $request->middlename;
        $users->phone = $request->phone;
        $users->birth_date = $request->birth_date;
        $users->passport = $request->passport;
        $users->email = $request->email;
        if($request->status){
            $users->status = 0;
        }else{
            $users->status = 1;
        }
        $users->gender = $request->gender;
        $users->address_id = $address->id;
        $users->role = $request->role;
        $users->company_id = $request->company;
        $users->organization_id = $request->organization;
        $users->store_id = $request->store;
        $users->password = Hash::make($request->new_password);
        if($request->image){
            $image = $request->file('image');
            $random = $this->setRandom();
            $product_image_name = $random.''.date('Y-m-dh-i-s').'.'.$image->extension();
            $image->storeAs('public/users/', $product_image_name);
            $users->image =  $product_image_name;
        }
        $users->save();
        return redirect()->route('users.index')->with('success', translate_title('Successfully created', $this->lang));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $lang = App::getLocale();
        $roles = [
            ['value'=>1, 'name'=>'superadmin'],
            ['value'=>2, 'name'=>'admin'],
            ['value'=>3, 'name'=>'manager'],
            ['value'=>4, 'name'=>'cashier'],
            ['value'=>5, 'name'=>'suppliers']
        ];

        $companies_ = Company::all();
        $companies = [];
        foreach($companies_ as $company) {
            $companies[] = [
                'id'=>$company->id,
                'name'=>$company->name
            ];
        }

        $organizations_ = Organization::all();
        $organizations = [];
        foreach($organizations_ as $organization) {
            $organizations[] = [
                'id'=>$organization->id,
                'name'=>$organization->name
            ];
        }
        return view('superadmin.stuffs.edit', [
            'user'=>$user,
            'roles'=>$roles,
            'companies'=>$companies,
            'organizations'=>$organizations,
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
        $users = User::find($id);
        if ($request->password && $request->new_password && $request->password_confirmation) {
            if($request->email){
                if (Hash::check($request->password, $users->password) && $request->new_password == $request->password_confirmation) {
                    $users->password = Hash::make($request->new_password);
                }else{
                    if(!Hash::check($request->password, $users->password)){
                        return redirect()->back()->with('error', translate_title('Your password is incorrect', $this->lang));
                    }elseif($request->new_password != $request->password_confirmation){
                        return redirect()->back()->with('error', translate_title('Your new password confirmation is incorrect', $this->lang));
                    }
                }
            }else{
                return redirect()->back()->with('error', translate_title('Your don\'t have email', $this->lang));
            }
        }elseif($request->password && $request->new_password && !$request->password_confirmation){
            return redirect()->back()->with('error', translate_title('Your new password confirmation is incorrect', $this->lang));
        }
        if($users->address){
            $address = $users->address;
        }else{
            $address = new Address();
        }
        if($request->district){
            $address->city_id = $request->district;
        }elseif($request->region){
            $address->city_id = $request->region;
        }
        $address->name = $request->address;
        $address->save();
        $users->name = $request->name;
        $users->surname = $request->surname;
        $users->phone = $request->phone;
        $users->birth_date = $request->birth_date;
        $users->gender = $request->gender;
        $users->email = $request->email;
        $users->passport = $request->passport;
        $users->address_id = $address->id;
        if($request->status){
            $users->status = 0;
        }else{
            $users->status = 1;
        }
        $users->company_id = $request->company;
        $users->organization_id = $request->organization;
        $users->store_id = $request->store;
        $users->role = $request->role;
        if($request->image){
            if(!$users->image){
                $users->image = 'no';
            }
            $old_image = storage_path("app/public/users/$users->image");
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $image = $request->file('image');
            $random = $this->setRandom();
            $product_image_name = $random.''.date('Y-m-dh-i-s').'.'.$image->extension();
            $image->storeAs('public/users/', $product_image_name);
            $users->image =  $product_image_name;
        }
        $users->address_id = $address->id;
        $users->save();
        return redirect()->route('users.index')->with('success', translate_title('Successfully updated', $this->lang));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::withTrashed()->find($id);
        if(!$users->image){
            $users->image = 'no';
        }
        $old_image = storage_path("app/public/users/$users->image");
        if(file_exists($old_image)){
            unlink($old_image);
        }
        $users->forceDelete();
        return redirect()->route('users.index')->with('success', translate_title('Successfully deleted', $this->lang));
    }
}
