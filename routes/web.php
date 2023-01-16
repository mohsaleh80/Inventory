<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Customer\customerController ;
use App\Http\Controllers\Unit\unitController;
use App\Http\Controllers\Category\categoryController;
use App\Http\Controllers\Product\productController;
use App\Http\Controllers\Purchase\purchaseController;
use App\Http\Controllers\default\defaultController;
use App\Http\Controllers\Invoice\invoiceController;
use App\Http\Controllers\Stock\stockController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::controller(AdminController::class)->group(function(){

    Route::get('/admin/logout','destroy')->name('admin.logout');
    Route::get('/admin/profile','profile')->name('admin.profile');
    Route::get('/edit/profile','editProfile')->name('edit.profile');
    Route::post('/update/profile','updateProfile')->name('update.profile');
    
    Route::get('/change/password','changePassword')->name('change.password');
    Route::post('/update/password','updatePassword')->name('update.password');

});

Route::controller(SupplierController::class)->group(function(){

    Route::get('/supplier/all','index')->name('supplier.all'); 
    Route::get('/supplier/add','create')->name('supplier.add'); 
    Route::post('/supplier/add','store')->name('supplier.add');
    Route::get('/supplier/{id}/edit','edit')->name('supplier.edit');
    Route::put('/supplier/{id}','update')->name('supplier.update'); 
    Route::delete('/supplier/{id}','destroy')->name('supplier.destroy');
});

Route::controller(customerController::class)->group(function(){

    Route::get('/customer/all','index')->name('customer.all'); 
    Route::get('/customer/add','create')->name('customer.add'); 
    Route::post('/customer/add','store')->name('customer.add');
    Route::get('/customer/{id}/edit','edit')->name('customer.edit');
    Route::put('/customer/{id}','update')->name('customer.update'); 
    Route::delete('/customer/{id}','destroy')->name('customer.destroy');
});

Route::controller(unitController::class)->group(function(){

    Route::get('/unit/all','index')->name('unit.all'); 
    Route::get('/unit/add','create')->name('unit.add'); 
    Route::post('/unit/add','store')->name('unit.add');
    Route::get('/unit/{id}/edit','edit')->name('unit.edit');
    Route::put('/unit/{id}','update')->name('unit.update'); 
    Route::delete('/unit/{id}','destroy')->name('unit.destroy');
});

Route::controller(categoryController::class)->group(function(){

    Route::get('/category/all','index')->name('category.all'); 
    Route::get('/category/add','create')->name('category.add'); 
    Route::post('/category/add','store')->name('category.add');
    Route::get('/category/{id}/edit','edit')->name('category.edit');
    Route::put('/category/{id}','update')->name('category.update'); 
    Route::delete('/category/{id}','destroy')->name('category.destroy');
});

Route::controller(productController::class)->group(function(){

    Route::get('/product/all','index')->name('product.all'); 
    Route::get('/product/add','create')->name('product.add'); 
    Route::post('/product/add','store')->name('product.add');
    Route::get('/product/{id}/edit','edit')->name('product.edit');
    Route::put('/product/{id}','update')->name('product.update'); 
    Route::delete('/product/{id}','destroy')->name('product.destroy');
});

Route::controller(purchaseController::class)->group(function(){

    Route::get('/purchase/all','index')->name('purchase.all'); 
    Route::get('/purchase/add','create')->name('purchase.add'); 
    Route::post('/purchase/add','store')->name('purchase.add');
    Route::get('/purchase/{id}/edit','edit')->name('purchase.edit');
    Route::put('/purchase/{id}','update')->name('purchase.update'); 
    Route::delete('/purchase/{id}','destroy')->name('purchase.destroy');

    Route::get('/purchase/pending','PurchasePending')->name('purchase.pending');
    Route::get('/purchase/approve/{id}', 'PurchaseApprove')->name('purchase.approve');
});

Route::controller(invoiceController::class)->group(function(){

    Route::get('/invoice/all','index')->name('invoice.all'); 
    Route::get('/invoice/add','create')->name('invoice.add'); 
    Route::post('/invoice/add','store')->name('invoice.add');
    Route::get('/invoice/{id}/edit','edit')->name('invoice.edit');
    Route::put('/invoice/{id}','update')->name('invoice.update'); 
    Route::delete('/invoice/{id}','destroy')->name('invoice.destroy');

    Route::get('/invoice/pending/list', 'InvoicePendingList')->name('invoice.pending.list');
    Route::get('/invoice/show/{id}', 'InvoiceShow')->name('invoice.show');
    Route::post('/invoice/approve/{id}', 'InvoiceApprove')->name('invoice.approve');
    Route::get('/print/invoice/list', 'PrintInvoiceList')->name('print.invoice.list');
    Route::get('/invoice/print/{id}', 'PrintInvoice')->name('invoice.print');
    Route::get('/daily/invoice/report', 'DailyInvoiceReport')->name('daily.invoice.report');
    Route::get('/daily/invoice/pdf', 'DailyInvoicePdf')->name('daily.invoice.pdf');
    
    
    //Route::get('/invoice/pending','InvoicePending')->name('invoice.pending');

    
});

Route::controller(stockController::class)->group(function(){

    Route::get('/stock/report','StockReport')->name('stock.report'); 
    Route::get('/stock/supplier/report','StockSupplierReport')->name('stock.supplier.report'); 
    Route::get('/supplier/wise/pdf','SupplierWisePDF')->name('supplier.wise.pdf'); 
    
});


// Default All Route 
Route::controller(DefaultController::class)->group(function () {
    Route::get('/get-category', 'GetCategory')->name('get-category'); 
    Route::get('/get-product', 'GetProduct')->name('get-product'); 
    Route::get('/get-unit', 'GetUnit')->name('get-unit'); 


});




Route::get('/dashboard1', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
/*
Route::get('/admin', function () {
    return view('admin.admin_master');
});

Route::get('/index', function () {
    return view('admin.index');
});
*/

require __DIR__.'/auth.php';
