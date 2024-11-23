<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Superadmin\ProductsController;
use App\Http\Controllers\Superadmin\CompanyController;
use App\Http\Controllers\Superadmin\OrganizationController;
use App\Http\Controllers\Superadmin\StoreController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('delete-product', [ProductsController::class, 'deleteProductImage']);
Route::post('delete-company', [CompanyController::class, 'deleteCompanyImage']);
Route::post('delete-organization', [OrganizationController::class, 'deleteOrganizationImage']);
Route::post('delete-store', [StoreController::class, 'deleteStoreImage']);
Route::get('get-stores/{id}', [StoreController::class, 'getStores']);

