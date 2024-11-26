<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Company;
use App\Models\User;
use App\Service\ProductsService;
use App\Service\SaveImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public $title;
    public $saveImages;
    public $productsService;
    public $lang;

    public function __construct(SaveImages $saveImages, ProductsService $productsService)
    {
        $this->title = $this->getTableTitle('Users');
        $this->saveImages = $saveImages;
        $this->productsService = $productsService;
    }

    public function index()
    {
        $lang = App::getLocale();
        $companies_ = Company::all();
        $companies = [];
        foreach($companies_ as $company) {
            $images = [];
            if ($company->images) {
                $images_ = json_decode($company->images);
                $is_image = 0;
                foreach ($images_ as $image) {
                    if(!$image){
                        $image = 'no';
                    }
                    $avatar_main = storage_path('app/public/companies/' . $image);
                    if (file_exists($avatar_main)) {
                        $is_image = 1;
                        $images[] = asset("storage/companies/$image");
                    }
                }
                if($is_image == 0){
                    $images = [asset('storage/icon/no_photo.jpg')];
                }
            }else{
                $images = [asset('storage/icon/no_photo.jpg')];
            }
            $companies[] = [
                'id'=>$company->id,
                'name'=>$company->name,
                'address'=>$company->address_id,
                'images'=>$images,
            ];
        }
        return view('superadmin.companies.index', [
            'companies'=>$companies,
            'title'=>$this->title,
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
        $company = new Company();
        $company->name = $request->name;
        $company->address_id = $address->id;
        $images = $request->file('images');
        $company->images = $this->saveImages->imageSave($company, $images, 'update', 'companies');
        $company->save();
        return redirect()->route('companies.index')->with('success', translate_title('Successfully created', $this->lang));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lang = App::getLocale();
        $company_ = Company::find($id);
        $images = [];
        $images_ = [];
        if ($company_->images) {
            $images_ = json_decode($company_->images);
            $is_image = 0;
            foreach ($images_ as $image) {
                if(!$image){
                    $image = 'no';
                }
                $avatar_main = storage_path('app/public/companies/' . $image);
                if (file_exists($avatar_main)) {
                    $is_image = 1;
                    $images[] = asset("storage/companies/$image");
                }
            }
            if($is_image == 0){
                $images = [asset('storage/icon/no_photo.jpg')];
            }
        }else{
            $images = [asset('storage/icon/no_photo.jpg')];
        }
        $company = [
            'id'=>$company_->id,
            'name'=>$company_->name,
            'address'=>$company_->address,
            'images'=>$images,
        ];

        return view('superadmin.companies.edit', [
            'company'=>$company,
            'images'=>$images_,
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
        $company = Company::find($id);
        if($company->address){
            $address = $company->address;
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
        $company->name = $request->name;
        $images = $request->file('images');
        $company->images = $this->saveImages->imageSave($company, $images, 'update', 'companies');
        $company->address_id = $address->id;
        $company->save();
        return redirect()->route('companies.index')->with('success', translate_title('Successfully updated', $this->lang));
    }

    public function deleteCompanyImage(Request $request){
        $model = Company::find($request->id);
        $this->productsService->deleteImage($request, $model, 'companies');
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
        $company = Company::find($id);
        if($company->images){
            $images = json_decode($company->images);
            foreach ($images as $image){
                $product_image = storage_path('app/public/companies/'.$image);
                if(file_exists($product_image)){
                    unlink($product_image);
                }
            }
        }
        $company->delete();
        return redirect()->route('companies.index')->with('success', translate_title('Successfully deleted', $this->lang));
    }
}
