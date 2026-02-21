<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;


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

});


Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');


    });

require __DIR__.'/auth.php';
