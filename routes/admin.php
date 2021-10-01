<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\Admin\HomeController;
use App\http\Controllers\Admin\BusinessController;
use App\http\Controllers\Admin\Purchase;
use App\http\Controllers\Admin\CategoryController;
use App\http\Controllers\ClientController;
use App\http\Controllers\ProductController;
use App\http\Controller\Admin\ProviderController;

Route::get('', [HomeController::class, 'index'])->name('home');
Route::get('/hola', function () {
    return "hola";
})->name('hola');

Route::resource('admin/business', BusinessController::class)->names('business')->only([
    'index', 'update'
]);
//Route::resource('printers', 'PrinterController')->names('printers')->only([
//    'index', 'update'
//]);

Route::resource('admin/categories', CategoryController::class)->names('categories');
Route::resource('admin/clients', ClientController::class)->names('clients');
Route::resource('admin/products', ProductController::class)->names('products');
Route::resource('admin/providers', ProviderController::class)->names('providers');
Route::resource('admin/purchases', PurchaseController::class)->names('purchaseslte')->except([
    'edit', 'update', 'destroy'
]);
Route::resource('admin/sales', SaleController::class)->names('sales')->except([
    'edit', 'update', 'destroy'
]);
Route::get('admin/purchases/pdf/{purchase}', [PurchaseController::class,'pdf'])->name('purchases.pdf');
Route::get('admin/sales/pdf/{sale}', [SaleController::class,'pdf'])->name('sales.pdf');
Route::get('admin/sales/print/{sale}', [SaleController::class, 'print'])->name('sales.print');

Route::get('admin/purchases/upload/{purchase}', [PurchaseController::class,'upload'])->name('upload.purchases');

Route::get('admin/change_status/products/{product}', [ProductController::class,'change_status'])->name('change.status.products');
Route::get('admin/change_status/purchases/{purchase}', [PurchaseController::class,'change_status'])->name('change.status.purchases');
Route::get('admin/change_status/sales/{sale}', [SaleController::class,'change_status'])->name('change.status.sales');

Route::resource('admin/users', UserController::class)->names('users');

Route::resource('admin/roles', RoleController::class)->names('roles');

Route::get('get_products_by_id', [ProductController::class,'get_products_by_id'])->name('get_products_by_id');


Route::get('/prueba', function () {
    return view('prueba');
});

Auth::routes();
Auth::routes(['register' => false]);
Route::get('/home', [HomeController::class,'index'])->name('home');

Route::get('/premios', [PremiosController::class, 'index'])->name('premios');
Route::post('/consulta_puntos', [PremiosController::class, 'consultarPuntos'])->name('consulta_puntos');