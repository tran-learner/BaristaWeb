<?php

use App\Http\Controllers\DrinkController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\YourPaymentController; // Or dedicated PaymentController
use App\Http\Controllers\Setting;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('initDrinkList');
});

Route::get('/drinks', [DrinkController::class,'getDrinks'])->name('initDrinkList');
Route::get('/ingredients', [IngredientController::class,'index'])->name('getIngredients');
Route::get('/setting', [Setting::class, 'setting'])->name('Setting');

// Route to initiate payment (example)
Route::post('/order/{orderId}/pay', [YourPaymentController::class, 'initiatePayment'])->name('payment.create');

// User redirection routes (GET)
Route::get('/payment/return/{order_id}',)->name('payment.return');
Route::get('/payment/cancel/{order_id}', [YourPaymentController::class, 'handleCancel'])->name('payment.cancel');

// PayOS Webhook route (POST)
Route::post('/payment/webhook', [YourPaymentController::class, 'handleWebhook'])->name('payment.webhook');