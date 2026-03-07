<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;


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
    Route::get('/', function (){
        return view('admin.index');

    });
    Route::resource('/medicine',  MedicineController::class );
    Route::resource('/category', CategoryController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/purchase', PurchaseController::class );
    Route::resource('/purchase_item', PurchaseItemController::class);
    Route::get('/users/table', [UserController::class, 'table'])->name('users.table');
    Route::resource('/users', UserController::class);

});


Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('/profile', ProfileController::class );

       

    });

require __DIR__.'/auth.php';
