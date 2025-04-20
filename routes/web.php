<?php

use App\Http\Controllers\DrinkController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Setting;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('initDrinkList');
});

Route::get('/drinks', [DrinkController::class,'getDrinks'])->name('initDrinkList');
Route::get('/ingredients', [IngredientController::class,'index'])->name('getIngredients');
Route::get('/setting', [Setting::class, 'setting'])->name('Setting');


Route::get('/checkout', [PaymentController::class, 'showCheckoutForm'])->name('checkout.form');
Route::post('/checkout', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/callback', [PaymentController::class, 'handleCallback'])->name('payment.callback');
Route::post('/payment/webhook', [PaymentController::class, 'handleWebhook'])->name('payment.webhook');