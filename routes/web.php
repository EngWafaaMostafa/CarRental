<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AdminsController;

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
