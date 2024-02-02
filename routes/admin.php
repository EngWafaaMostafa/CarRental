<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AdminsController;


Route::group(["prefix" => "Admin", "as" => "Admin.", "middleware" => "verified"], function () {
    Route::group(["prefix" => "users", "as" => "users."], function () {
        Route::get('createuser', [AdminsController::class, 'createuser'])->name('createuser');
        Route::post('storeuser', [AdminsController::class, 'store'])->name('store');
        Route::get('showusers', [AdminsController::class, 'index'])->name('show');
    });
});
