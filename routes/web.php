<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
Route::group(['prefix' => 'account'], function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'index')->name(name: 'account.login');
            Route::post('authenticate', 'authenticate')->name(name:'account.authenticate');
            Route::get('register','register')->name(name:'account.register');
            Route::post('process-register','processRegister')->name(name:'account.processRegister'); 
       
    });
});
});


// Route::controller(CartController::class)->group(function () {
//     Route::get('/add-to-cart/{id}', 'addToCart')->name('add.to.cart');
//     Route::get('/cart', 'cart')->name('cart');
//     Route::post('/cart-update', 'cartUpdate')->name('cart.update');
// });
// Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::controller(CartController::class)->group(function () {
        Route::get('/add-to-cart/{id}', 'addToCart')->name('add.to.cart');
        Route::get('/cart', 'cart')->name('cart');
        Route::post('/cart-update', 'cartUpdate')->name('cart.update');
    });

    Route::get('/home', [HomeController::class, 'index'])->name('home');
     Route::get('logout', [LoginController::class, 'logout'])->name(name: 'account.logout');
});

