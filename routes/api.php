<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Superadmin\ProductsController;
use App\Http\Controllers\Superadmin\CompanyController;
use App\Http\Controllers\Superadmin\OrganizationController;
use App\Http\Controllers\Superadmin\StoreController;
use App\Http\Controllers\Cashier\CashboxController;
use App\Http\Controllers\Cashier\CashierProductsController;
use App\Http\Controllers\Cashier\PaymentsController;
use App\Http\Controllers\GiftCardController;

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

Route::group(['middleware'=>'auth:sanctum'], function () {
    Route::post('payment-pay', [CashboxController::class, 'paymentPay'])->name('paymentPay');
    Route::post('gift-card', [GiftCardController::class, 'giftCard'])->name('giftCard');
    Route::post('cashback', [GiftCardController::class, 'cashback'])->name('cashback');
    Route::get('get-check-aside', [CashboxController::class, 'getCheckAside'])->name('getCheckAside');
    Route::post('confirm-return', [PaymentsController::class, 'confirmReturn'])->name('confirmReturn');
    Route::post('get-notification', [HomeController::class, 'getNotification'])->name('getNotification');
    Route::post('payment-delete', [PaymentsController::class, 'paymentDeleteFunc'])->name('paymentDeleteFunc');
});

Route::post('delete-product', [ProductsController::class, 'deleteProductImage']);
Route::post('cashier-delete-product', [CashierProductsController::class, 'deleteProductImage']);
Route::post('delete-company', [CompanyController::class, 'deleteCompanyImage']);
Route::post('delete-organization', [OrganizationController::class, 'deleteOrganizationImage']);
Route::post('delete-store', [StoreController::class, 'deleteStoreImage']);
Route::get('get-stores/{id}', [StoreController::class, 'getStores']);

Route::get('get-products-by-category', [CashierProductsController::class, 'getProductsByCategory']);
