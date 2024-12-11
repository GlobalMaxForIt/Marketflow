<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\Cashier\CashierProductsController;
use App\Http\Controllers\Cashier\CashierDiscountController;
use App\Http\Controllers\Cashier\PaymentsController;
use App\Http\Controllers\Cashier\CashboxController;
use App\Http\Controllers\Superadmin\ProductsController;
use App\Http\Controllers\Superadmin\ProductsCategoriesController;
use App\Http\Controllers\Superadmin\ProductsSubCategoriesController;
use App\Http\Controllers\Superadmin\DiscountController;
use App\Http\Controllers\Superadmin\UserController;
use App\Http\Controllers\Superadmin\OrganizationController;
use App\Http\Controllers\Superadmin\StoreController;
use App\Http\Controllers\Superadmin\CompanyController;
use App\Http\Controllers\Superadmin\TableTranslationController;
use App\Http\Controllers\Superadmin\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/public', function (){
    return redirect()->route('dashboard');
});
Route::group(['middleware'=>['role', 'language']], function(){
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
});

Route::get('/barcode', [HomeController::class, 'barcode'])->name('barcode');

Route::group(['middleware'=>['auth', 'language']], function(){
    Route::get('api/get-districts', [HomeController::class, 'getCities']);
    Route::resource('clients', ClientsController::class);
    Route::get('api/subcategory/{id}', [\App\Http\Controllers\Superadmin\ProductsCategoriesController::class, 'getSubcategory'])->name('get_subcategory');
});

Route::group(['middleware'=>['isAdmin', 'language'], 'prefix'=>'admin'], function(){
    Route::get('/', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('admin.index');
    Route::get('/table', [\App\Http\Controllers\Admin\IndexController::class, 'table'])->name('admin.table');
});

Route::get('/set-cities', [HomeController::class, 'setCities']);
Route::group(['middleware'=>['isSuperAdmin', 'language'], 'prefix'=>'super-admin'], function(){
    Route::get('/', [\App\Http\Controllers\Superadmin\IndexController::class, 'index'])->name('superadmin.index');
    Route::resource('product', ProductsController::class);
    Route::resource('discount', DiscountController::class);
    Route::resource('users', UserController::class);
    Route::resource('organizations', OrganizationController::class);
    Route::resource('stores', StoreController::class);
    Route::resource('companies', CompanyController::class);

    Route::resource('products-categories', ProductsCategoriesController::class);
    Route::resource('products-sub-categories', ProductsSubCategoriesController::class);

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/set-cities', [HomeController::class, 'setCities']);

    Route::group(['prefix' => 'table'], function () {
        Route::get('translation', [TableTranslationController::class, 'index'])->name('table.index');
        Route::get('show/{type}', [TableTranslationController::class, 'show'])->name('table.show');
        Route::get('table-show', [TableTranslationController::class, 'tableShow'])->name('table.tableShow');
        Route::post('/translation/save/', [TableTranslationController::class, 'translation_save'])->name('table_translation.save');
    });
    Route::group(['prefix' => 'language'], function () {
        Route::get('/', [LanguageController::class, 'index'])->name('language.index');
        Route::get('/language/show/{id}', [LanguageController::class, 'show'])->name('language.show');
        Route::post('/translation/save/', [LanguageController::class, 'translation_save'])->name('translation.save');
        Route::post('/env_key_update', [LanguageController::class, 'env_key_update'])->name('env_key_update.update');
        Route::get('/language/create/', [LanguageController::class, 'create'])->name('languages.create');
        Route::post('/language/added/', [LanguageController::class, 'store'])->name('languages.store');
        Route::get('/language/edit/{id}', [LanguageController::class, 'languageEdit'])->name('language.edit');
        Route::put('/language/update/{id}', [LanguageController::class, 'update'])->name('language.update');
        Route::delete('/language/delete/{id}', [LanguageController::class, 'languageDestroy'])->name('language.destroy');
        Route::post('/language/update/value', [LanguageController::class, 'updateValue'])->name('languages.update_value');
    });
});

Route::post('/language/change/', [LanguageController::class, 'changeLanguage'])->name('language.change');

Route::group(['middleware'=>['isCashier', 'language'], 'prefix'=>'cashier'], function(){
    Route::get('/', [\App\Http\Controllers\Cashier\IndexController::class, 'index'])->name('cashier.index');
    Route::resource('cashier-product', CashierProductsController::class);
    Route::post('change-cashier', [CashboxController::class, 'changeCashier'])->name('changeCashier');
    Route::resource('cashbox', CashboxController::class);
    Route::get('cashbox-small', [CashboxController::class, 'indexSmall'])->name('indexSmall');
    Route::get('cashbox-large', [CashboxController::class, 'indexLarge'])->name('indexLarge');
    Route::resource('cashier-discount', CashierDiscountController::class);
    Route::get('payments', [PaymentsController::class, 'index'])->name('payments');
});
Route::group(['middleware'=>['isManager', 'language'], 'prefix'=>'manager'], function(){
    Route::get('/', [\App\Http\Controllers\Manager\IndexController::class, 'index'])->name('manager.index');
});
Route::group(['middleware'=>['isSupplier', 'language'], 'prefix'=>'supplier'], function(){
    Route::get('/', [\App\Http\Controllers\Supplier\IndexController::class, 'index'])->name('supplier.index');
});


Route::group(['middleware'=>['isAuth']], function(){

});

Auth::routes();

