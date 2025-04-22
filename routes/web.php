<?php

use App\Http\Controllers\DrinkController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\PaymentController; // Or dedicated PaymentController
use App\Http\Controllers\Setting;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('initDrinkList');
});

Route::get('/drinks', [DrinkController::class,'getDrinks'])->name('initDrinkList');
Route::get('/ingredients', [IngredientController::class,'index'])->name('getIngredients');
Route::get('/setting', [Setting::class, 'setting'])->name('Setting');



Route::get('/pay', [PaymentController::class, 'create'])->name('payment.create');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::post('/payos/webhook', [PaymentController::class, 'handleWebhook']);
