<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\CategoriesController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [CarController::class, 'index'])->name('index');
//Auth::routes(["verify" => true]);
Route::get('adduser', [AdminsController::class, 'create'])->name('adduser');
Route::post('adduser', [AdminsController::class, 'store'])->name('adduser');
Route::get('users', [AdminsController::class, 'index'])->name('users');
Route::get('updateuser/{id}', [AdminsController::class, 'edit']);
Route::put('updateuser/{id}', [AdminsController::class, 'update'])->name('updateuser');

Route::get('addcategory', [CategoriesController::class, 'create'])->name('addcategory');
Route::post('addcategory', [CategoriesController::class, 'store'])->name('addcategory');
Route::get('categories', [CategoriesController::class, 'index'])->name('categories');
Route::get('updatecategory/{id}', [CategoriesController::class, 'edit']);
Route::put('updatecategory/{id}', [CategoriesController::class, 'update'])->name('updatecategory');
Route::get('deletecategory/{id}', [CategoriesController::class, 'destroy']);

Route::get('addcar', [CarController::class, 'create'])->name('addcar');
Route::post('addcar', [CarController::class, 'store'])->name('addcar');
//Route::get('cars', [CarController::class, 'index'])->name('cars');
//Route::get('updatecar/{id}', [CarController::class, 'edit']);
//Route::put('updatecar/{id}', [CarController::class, 'update'])->name('updatecar');
//Route::get('deletecar/{id}', [CarController::class, 'destroy']);
