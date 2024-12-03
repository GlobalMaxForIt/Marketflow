<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Organization;
use App\Models\User;
use App\Service\ProductsService;
use App\Service\SaveImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrganizationController extends Controller
{
    public $title;
    public $saveImages;
    public $productsService;
    public $lang;
    public $current_page = 'organization';

    public function __construct(SaveImages $saveImages, ProductsService $productsService)
    {
        $this->title = $this->getTableTitle('Users');
        $this->saveImages = $saveImages;
        $this->productsService = $productsService;
    }

    public function index()
    {
        $lang = App::getLocale();
        $organizations_ = Organization::all();
        $organizations = [];
        foreach($organizations_ as $organization) {
            $images = [];
            if ($organization->images) {
                $images_ = json_decode($organization->images);
                $is_image = 0;
                foreach ($images_ as $image) {
                    if(!$image){
                        $image = 'no';
                    }
                    $avatar_main = storage_path('app/public/organizations/' . $image);
                    if (file_exists($avatar_main)) {
                        $is_image = 1;
                        $images[] = asset("storage/organizations/$image");
                    }
                }
                if($is_image == 0){
                    $images = [asset('icon/no_photo.jpg')];
                }
            }else{
                $images = [asset('icon/no_photo.jpg')];
            }
            $organizations[] = [
                'id'=>$organization->id,
                'name'=>$organization->name,
                'address'=>$organization->address_id,
                'images'=>$images,
            ];
        }

        return view('superadmin.organizations.index', [
            'organizations'=>$organizations,
            'title'=>$this->title,
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
        $organization = new Organization();
        $organization->name = $request->name;
        $organization->address_id = $address->id;
        $images = $request->file('images');
        $organization->images = $this->saveImages->imageSave($organization, $images, 'update', 'organizations');
        $organization->save();
        return redirect()->route('organizations.index')->with('success', translate_title('Successfully created', $this->lang));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lang = App::getLocale();
        $organization_ = Organization::find($id);
        $images = [];
        $images_ = [];
        if ($organization_->images) {
            $images_ = json_decode($organization_->images);
            $is_image = 0;
            foreach ($images_ as $image) {
                if(!$image){
                    $image = 'no';
                }
                $avatar_main = storage_path('app/public/organizations/' . $image);
                if (file_exists($avatar_main)) {
                    $is_image = 1;
                    $images[] = asset("storage/organizations/$image");
                }
            }
            if($is_image == 0){
                $images = [asset('icon/no_photo.jpg')];
            }
        }else{
            $images = [asset('icon/no_photo.jpg')];
        }
        $organization = [
            'id'=>$organization_->id,
            'name'=>$organization_->name,
            'address'=>$organization_->address,
            'images'=>$images,
        ];

        return view('superadmin.organizations.edit', [
            'organization'=>$organization,
            'images'=>$images_,
            'title'=>$this->title,
            'lang'=>$lang,
            'current_page'=>$this->current_page
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
        $organization = Organization::find($id);
        if($organization->address){
            $address = $organization->address;
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
        $organization->name = $request->name;
        $images = $request->file('images');
        $organization->images = $this->saveImages->imageSave($organization, $images, 'update', 'organizations');
        $organization->address_id = $address->id;
        $organization->save();
        return redirect()->route('organizations.index')->with('success', translate_title('Successfully updated', $this->lang));
    }

    public function deleteOrganizationImage(Request $request){
        $model = Organization::find($request->id);
        $this->productsService->deleteImage($request, $model, 'organizations');
        return response()->json([
            'status'=>true,
            'message'=>'Success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $organization = Organization::find($id);
        if($organization->images){
            $images = json_decode($organization->images);
            foreach ($images as $image){
                $product_image = storage_path('app/public/organizations/'.$image);
                if(file_exists($product_image)){
                    unlink($product_image);
                }
            }
        }
        $organization->delete();
        return redirect()->route('organizations.index')->with('success', translate_title('Successfully deleted', $this->lang));
    }
}
