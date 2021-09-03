<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\Admin\HomeController;

Route::get('', [HomeController::class, 'index']);
Route::get('/hola', function () {
    return "hola";
})->name('hola');

Route::resource('business', BusinessController::class)->names('business')->only([
    'index', 'update'
]);
//Route::resource('printers', 'PrinterController')->names('printers')->only([
//    'index', 'update'
//]);

Route::resource('categories', CategoryController::class)->names('categories');
Route::resource('clients', ClientController::class)->names('clients');
Route::resource('products', ProductController::class)->names('products');
Route::resource('providers', ProviderController::class)->names('providers');
Route::resource('purchases', PurchaseController::class)->names('purchases')->except([
    'edit', 'update', 'destroy'
]);
Route::resource('sales', SaleController::class)->names('sales')->except([
    'edit', 'update', 'destroy'
]);
Route::get('purchases/pdf/{purchase}', [PurchaseController::class,'pdf'])->name('purchases.pdf');
Route::get('sales/pdf/{sale}', [SaleController::class,'pdf'])->name('sales.pdf');
Route::get('sales/print/{sale}', [SaleController::class, 'print'])->name('sales.print');

Route::get('purchases/upload/{purchase}', [PurchaseController::class,'upload'])->name('upload.purchases');

Route::get('change_status/products/{product}', [ProductController::class,'change_status'])->name('change.status.products');
Route::get('change_status/purchases/{purchase}', [PurchaseController::class,'change_status'])->name('change.status.purchases');
Route::get('change_status/sales/{sale}', [SaleController::class,'change_status'])->name('change.status.sales');

Route::resource('users', UserController::class)->names('users');

Route::resource('roles', RoleController::class)->names('roles');

Route::get('get_products_by_id', [ProductController::class,'get_products_by_id'])->name('get_products_by_id');


Route::get('/prueba', function () {
    return view('prueba');
});

Auth::routes();
Auth::routes(['register' => false]);
Route::get('/home', [HomeController::class,'index'])->name('home');

Route::get('/premios', [PremiosController::class, 'index'])->name('premios');
Route::post('/consulta_puntos', [PremiosController::class, 'consultarPuntos'])->name('consulta_puntos');