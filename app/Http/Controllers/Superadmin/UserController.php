<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\Address;
use App\Models\Company;
use App\Models\Organization;
use App\Models\PersonalInfo;
use App\Models\Store;
use App\Models\User;
use App\Service\AddressService;
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
    public $address_service;
    public $lang;
    public $current_page = 'user';

    public function __construct(UserService $user_service, AddressService $addressService)
    {
        $this->title = $this->getTableTitle('Users');
        $this->user_service = $user_service;
        $this->address_service = $addressService;
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
                'role'=>$role,
                'email'=>$user->email,
                'status'=>$status,
                'company'=>$user->company?$user->company->name:'',
                'organization'=>$user->organization?$user->organization->name:'',
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
            'lang'=>$lang,
            'current_page'=>$this->current_page
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

        $personal_info = new PersonalInfo();
        $personal_info->middlename = $request->middlename;
        if($request->image){
            $image = $request->file('image');
            $random = $this->setRandom();
            $product_image_name = $random.''.date('Y-m-dh-i-s').'.'.$image->extension();
            $image->storeAs('public/users/', $product_image_name);
            $personal_info->image =  $product_image_name;
        }
        $personal_info->phone = $request->phone;
        $personal_info->gender = $request->gender;
        $personal_info->birth_date = $request->birth_date;
        $personal_info->address_id = $address->id;
        $personal_info->passport = $request->passport;
        $personal_info->save();
        $users = new User();
        $users->name = $request->name;
        $users->surname = $request->surname;
        $users->email = $request->email;
        if($request->status){
            $users->status = 0;
        }else{
            $users->status = 1;
        }
        $users->role = $request->role;
        $users->company_id = $request->company;
        $users->organization_id = $request->organization;
        $users->store_id = $request->store;
        $users->password = Hash::make($request->new_password);
        $users->personal_info_id = $personal_info->id;
        $users->save();
        $token = $users->createToken('myapptoken')->plainTextToken;
        $users->token = $token;
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
        $user_ = [];
        if($user) {
            $gender = '';
            $middlename = '';
            $phone = '';
            $birth_date = '';
            $image = asset('icon/no_photo.jpg');
            $address = '';
            $passport = '';
            $personal_info = $user->personalInfo;
            if($personal_info){
                if ($personal_info->gender == \App\Constants::MALE) {
                    $gender = translate_title('Male', $this->lang);
                }elseif ($personal_info->gender == \App\Constants::FEMALE){
                    $gender = translate_title('Female', $this->lang);
                }
                $middlename = $personal_info->middlename??'';
                $phone = $personal_info->phone??'';
                $birth_date = $personal_info->birth_date??'';
                $user_image = $personal_info->image;
                if($user_image){
                    if(!$user_image){
                        $user_image = 'no';
                    }
                    $old_image = storage_path("app/public/users/$user_image");
                    if(file_exists($old_image)){
                        $image = asset('storage/users/'.$user_image);
                    }
                }
                $address = $personal_info->address;
                $passport = $personal_info->passport;
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

            $user_ = [
                'id'=>$user->id,
                'name'=>$user->name,
                'surname'=>$user->surname,
                'middlename'=>$middlename,
                'phone'=>$phone,
                'birth_date'=>$birth_date,
                'image'=>$image,
                'gender'=>$gender,
                'role'=>$role,
                'email'=>$user->email,
                'status'=>$status,
                'address'=>$address,
                'passport'=>$passport,
                'company'=>$user->company?$user->company->name:'',
                'organization'=>$user->organization?$user->organization->name:'',
                'updated_at'=>$user->updated_at,
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
        return view('superadmin.stuffs.edit', [
            'user'=>$user_,
            'roles'=>$roles,
            'companies'=>$companies,
            'organizations'=>$organizations,
            'title'=>$this->title,
            'lang'=>$lang,
            'current_page'=>$this->current_page
        ]);
    }

    public function show(string $id)
    {
        $user = User::find($id);
        $user_ = [];
        $lang = App::getLocale();
        if($user) {
            $gender = '';
            $middlename = '';
            $phone = '';
            $old = '';
            $image = asset('icon/no_photo.jpg');
            $address = '';
            $passport = '';
            $personal_info = $user->personalInfo;
            if($personal_info){
                if ($personal_info->gender == \App\Constants::MALE) {
                    $gender = translate_title('Male', $this->lang);
                }elseif ($personal_info->gender == \App\Constants::FEMALE){
                    $gender = translate_title('Female', $this->lang);
                }
                $middlename = $personal_info->middlename??'';
                $phone = $personal_info->phone??'';
                $old = $this->user_service->getOld($personal_info)??'';
                $user_image = $personal_info->image;
                if($user_image){
                    if(!$user_image){
                        $user_image = 'no';
                    }
                    $old_image = storage_path("app/public/users/$user_image");
                    if(file_exists($old_image)){
                        $image = asset('storage/users/'.$user_image);
                    }
                }
                $address = $this->address_service->getAddress($personal_info->address, $lang);
                $passport = $personal_info->passport;
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

            $user_ = [
                'id'=>$user->id,
                'name'=>$user->name,
                'surname'=>$user->surname,
                'middlename'=>$middlename,
                'phone'=>$phone,
                'old'=>$old,
                'image'=>$image,
                'gender'=>$gender,
                'role'=>$role,
                'email'=>$user->email,
                'status'=>$status,
                'address'=>$address,
                'passport'=>$passport,
                'company'=>$user->company?$user->company->name:'',
                'organization'=>$user->organization?$user->organization->name:'',
                'updated_at'=>$user->updated_at,
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
        return view('superadmin.stuffs.show', [
            'user'=>$user_,
            'title'=>$this->title,
            'lang'=>$lang,
            'current_page'=>$this->current_page
        ]);
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

        if($users->personalInfo){
            $personal_info = $users->personalInfo;
        }else{
            $personal_info = new PersonalInfo();
        }
        if($personal_info->address){
            $address = $personal_info->address;
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

        $personal_info->middlename = $request->middlename;
        if($request->image){
            if(!$personal_info->image){
                $personal_info->image = 'no';
            }
            $old_image = storage_path("app/public/users/$personal_info->image");
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $image = $request->file('image');
            $random = $this->setRandom();
            $product_image_name = $random.''.date('Y-m-dh-i-s').'.'.$image->extension();
            $image->storeAs('public/users/', $product_image_name);
            $personal_info->image =  $product_image_name;
        }

        $personal_info->phone = $request->phone;
        $personal_info->gender = $request->gender;
        $personal_info->birth_date = $request->birth_date;
        $personal_info->address_id = $address->id;
        $personal_info->passport = $request->passport;
        $personal_info->save();
        $users->name = $request->name;
        $users->surname = $request->surname;
        $users->email = $request->email;
        if($request->status){
            $users->status = 0;
        }else{
            $users->status = 1;
        }
        $users->role = $request->role;
        $users->company_id = $request->company;
        $users->organization_id = $request->organization;
        $users->store_id = $request->store;
        $users->password = Hash::make($request->new_password);
        $token = $users->createToken('myapptoken')->plainTextToken;
        $users->token = $token;
        $users->personal_info_id = $personal_info->id;
        $users->save();
        return redirect()->route('users.index')->with('success', translate_title('Successfully updated', $this->lang));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::withTrashed()->find($id);
        $personal_info = $users->personalInfo;
        if($personal_info){
            if(!$personal_info->image){
                $personal_info->image = 'no';
            }
            $old_image = storage_path("app/public/users/$personal_info->image");
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $personal_info->delete();
        }
        $users->forceDelete();
        return redirect()->route('users.index')->with('success', translate_title('Successfully deleted', $this->lang));
    }
}
