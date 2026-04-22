<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogsController;
use Illuminate\Supprot\Facades\Gate;

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







Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/', [HomeController::class, 'index']);

    //Search routes
    Route::get('medicine/search', [MedicineController::class, 'search'])->name('medicine.search');
    Route::get('purchase/search', [PurchaseController::class, 'search'])->name('purchase.search');
    Route::get('sale/search',     [SalesController::class, 'search'])->name('sale.search');
    Route::get('supplier/search', [SupplierController::class, 'search'])->name('supplier.search');
    Route::get('category/search', [CategoryController::class, 'search'])->name('category.search');
    Route::get('users/search',    [UserController::class, 'search'])->name('users.search');
    Route::get('purchase_item/search', [PurchaseItemController::class, 'search'])->name('purchase_item.search');

    Route::resource('/medicine',  MedicineController::class );
    Route::resource('/category', CategoryController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/purchase', PurchaseController::class );
    
    Route::resource('/sale', SalesController::class);
    Route::get('sale/{sale}/invoice-pdf', [SalesController::class, 'downloadPdf'])->name('sale.print');
    
    Route::resource('/purchase_item', PurchaseItemController::class);
    Route::get('/users/table', [UserController::class, 'table'])->middleware(['can:isAdmin'])->name('users.table');

    Route::middleware(['auth', 'can:isAdmin'])->group(function () {
    Route::resource('/users', UserController::class);
    });
    
    
    Route::middleware(['auth', 'can:isAdmin'])->group(function (){
        Route::get('/logs', [LogsController::class, 'index'])->name('logs.index');
    });
    



});


Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('/profile', ProfileController::class );

       

    });

require __DIR__.'/auth.php';
