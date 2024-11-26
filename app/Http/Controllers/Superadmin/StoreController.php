<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Company;
use App\Models\Organization;
use App\Models\Store;
use App\Service\ProductsService;
use App\Service\SaveImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public $title;
    public $saveImages;
    public $productsService;

    public function __construct(SaveImages $saveImages, ProductsService $productsService)
    {
        $this->title = $this->getTableTitle('Users');
        $this->saveImages = $saveImages;
        $this->productsService = $productsService;
    }

    public function index()
    {
        $stores_ = Store::all();
        $stores = [];
        foreach($stores_ as $store) {
            $images = [];
            if ($store->images) {
                $images_ = json_decode($store->images);
                $is_image = 0;
                foreach ($images_ as $image) {
                    if(!$image){
                        $image = 'no';
                    }
                    $avatar_main = storage_path('app/public/stores/' . $image);
                    if (file_exists($avatar_main)) {
                        $is_image = 1;
                        $images[] = asset("storage/stores/$image");
                    }
                }
                if($is_image == 0){
                    $images = [asset('storage/icon/no_photo.jpg')];
                }
            }else{
                $images = [asset('storage/icon/no_photo.jpg')];
            }
            $stores[] = [
                'id'=>$store->id,
                'name'=>$store->name,
                'address'=>$store->address_id,
                'images'=>$images,
                'organization'=>$store->organization
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
        return view('superadmin.stores.index', [
            'stores'=>$stores,
            'organizations'=>$organizations,
            'title'=>$this->title,
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
            return redirect()->back()->with('error', translate_title('Your new password confirmation is incorrect'));
        }
        if($request->new_password && !$request->email){
            return redirect()->back()->with('error', translate_title('Your don\'t have email'));
        }
        $address->name = $request->address;
        $address->save();
        $store = new Store();
        $store->name = $request->name;
        $store->address_id = $address->id;
        $store->organization_id = $request->organization_id;
        $images = $request->file('images');
        $store->images = $this->saveImages->imageSave($store, $images, 'update', 'stores');
        $store->save();
        return redirect()->route('stores.index')->with('success', translate_title('Successfully created'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $store_ = Store::find($id);
        $images = [];
        $images_ = [];
        if ($store_->images) {
            $images_ = json_decode($store_->images);
            $is_image = 0;
            foreach ($images_ as $image) {
                if(!$image){
                    $image = 'no';
                }
                $avatar_main = storage_path('app/public/stores/' . $image);
                if (file_exists($avatar_main)) {
                    $is_image = 1;
                    $images[] = asset("storage/stores/$image");
                }
            }
            if($is_image == 0){
                $images = [asset('storage/icon/no_photo.jpg')];
            }
        }else{
            $images = [asset('storage/icon/no_photo.jpg')];
        }
        $store = [
            'id'=>$store_->id,
            'name'=>$store_->name,
            'address'=>$store_->address,
            'images'=>$images,
            'organization_id'=>$store_->organization_id,
        ];

        $organizations_ = Organization::all();
        $organizations = [];
        foreach($organizations_ as $organization) {
            $organizations[] = [
                'id'=>$organization->id,
                'name'=>$organization->name
            ];
        }

        return view('superadmin.stores.edit', [
            'store'=>$store,
            'images'=>$images_,
            'organizations'=>$organizations,
            'title'=>$this->title,
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
        $store = Store::find($id);
        if($store->address){
            $address = $store->address;
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
        $store->name = $request->name;
        $images = $request->file('images');
        $store->images = $this->saveImages->imageSave($store, $images, 'update', 'stores');
        $store->address_id = $address->id;
        $store->organization_id = $request->organization_id;
        $store->save();
        return redirect()->route('stores.index')->with('success', translate_title('Successfully updated'));
    }

    public function deleteStoreImage(Request $request){
        $model = Store::find($request->id);
        $this->productsService->deleteImage($request, $model, 'stores');
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
        $store = Store::find($id);
        if($store->images){
            $images = json_decode($store->images);
            foreach ($images as $image){
                $product_image = storage_path('app/public/stores/'.$image);
                if(file_exists($product_image)){
                    unlink($product_image);
                }
            }
        }
        $store->delete();
        return redirect()->route('stores.index')->with('success', translate_title('Successfully deleted'));
    }


    public function getStores($id){
        $stores_ = Store::where('organization_id', $id)->get();
        $stores = [];
        foreach($stores_ as $store){
            $stores[] = [
                'id'=>$store->id,
                'name'=>$store->name,
            ];
        }
        $response = [
            'status'=>true,
            'data'=>$stores
        ];
        return response()->json($response);
    }
}
