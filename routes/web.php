<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TestmonialController;
use App\Http\Controllers\IndexController;
use Illuminate\Auth\Notifications\VerifyEmail;

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



Route::group(['middleware' => ['auth', 'auth.user_info']], function () {
    Route::get('/', [CarController::class, 'indexhome'])->middleware('verified')->name('index');

    //Auth::routes(["verify" => true]);
    Route::get('adduser', [AdminsController::class, 'create'])->middleware('verified')->name('adduser');
    Route::post('adduser', [AdminsController::class, 'store'])->middleware('verified')->name('adduser');
    Route::get('users', [AdminsController::class, 'index'])->middleware('verified')->name('users');
    Route::get('updateuser/{id}', [AdminsController::class, 'edit'])->middleware('verified');
    Route::put('updateuser/{id}', [AdminsController::class, 'update'])->middleware('verified')->name('updateuser');

    Route::get('addcategory', [CategoriesController::class, 'create'])->middleware('verified')->name('addcategory');
    Route::post('addcategory', [CategoriesController::class, 'store'])->middleware('verified')->name('addcategory');
    Route::get('categories', [CategoriesController::class, 'index'])->name('categories');
    Route::get('updatecategory/{id}', [CategoriesController::class, 'edit'])->middleware('verified');
    Route::put('updatecategory/{id}', [CategoriesController::class, 'update'])->middleware('verified')->name('updatecategory');
    Route::get('deletecategory/{id}', [CategoriesController::class, 'destroy'])->middleware('verified');

    Route::get('addcar', [CarController::class, 'create'])->name('addcar')->middleware('verified');
    Route::post('addcar', [CarController::class, 'store'])->name('addcar')->middleware('verified');
    Route::get('cars', [CarController::class, 'index'])->name('cars')->middleware('verified');
    Route::get('updatecar/{id}', [CarController::class, 'edit'])->middleware('verified');
    Route::put('updatecar/{id}', [CarController::class, 'update'])->middleware('verified')->name('updatecar');
    Route::get('deletecar/{id}', [CarController::class, 'destroy'])->middleware('verified');

    Route::get('addtestmonial', [TestmonialController::class, 'create'])->middleware('verified')->name('addtestmonial');
    Route::post('addtestmonial', [TestmonialController::class, 'store'])->middleware('verified')->name('addtestmonial');
    Route::get('testmonials', [TestmonialController::class, 'index'])->middleware('verified')->name('testmonials');
    Route::get('updatetestmonial/{id}', [TestmonialController::class, 'edit'])->middleware('verified');
    Route::put('updatetestmonial/{id}', [TestmonialController::class, 'update'])->middleware('verified')->name('updatetestmonial');
    Route::get('deletetestmonial/{id}', [TestmonialController::class, 'destroy'])->middleware('verified');


    Route::get('contact', function () {
        return view('contact');
    })->name('contact');

    Route::get('blog', function () {
        return view('blog');
    })->name('blog');

    Route::get('about', function () {
        return view('about');
    })->name('about');

    // Route::get('index', function () {
    //     return view('index');
    // })->name('index');
    Route::get('index', [CarController::class, 'indexhome'])->middleware('verified')->name('index');

    Route::get('listing', [CarController::class, 'list'])->middleware('verified')->name('listing');

    Route::get('showtestimonials', [TestmonialController::class, 'list'])->middleware('verified')->name('showtestimonials');

    Route::get('single/{id}', [CarController::class, 'show'])->middleware('verified')->name('single');
    //Route::get('single', [CategoriesController::class, 'list'])->name('singlecat');
    //Route::get('single', [CategoriesController::class, 'index'])->name('single');
    Route::post('sendcontact', [IndexController::class, 'sendcontact'])->name('sendcontact');

    Route::post('sendcontact', [IndexController::class, 'store'])->name('sendcontact');

    Route::get('message', [IndexController::class, 'index'])->middleware('verified')->name('message');

    Route::get('showmessage/{id}', [IndexController::class, 'show'])->middleware('verified')->name('showmessage');

    Auth::routes(['verify' => true]);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
