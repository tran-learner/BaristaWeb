<?php

use App\Http\Controllers\DrinkController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Setting;
use App\Http\Controllers\SuccessController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/teamInfo', [InfoController::class,'getInfo']);
Route::get('/member', [MemberController::class,'index'])->name('getInfos');

Route::get('/drinks', [DrinkController::class,'getDrinks'])->name('initDrinkList');

Route::get('/ingredients', [IngredientController::class,'index'])->name('getIngredients');
Route::get('/setting', [Setting::class, 'setting'])->name('Setting');



// Route::post('/checkout', function () {
//     return view('checkout');
// });

Route::post('/checkout', [CheckoutController::class, 'createPaymentLink']);
Route::get('/success', [SuccessController::class, 'success']);

Route::get('/cancel', function () {
    return view('cancel');
});


Route::get('/create-payment-link', [CheckoutController::class, 'createPaymentLink']);

Route::prefix('/order')->group(function () {
    Route::post('/create', [OrderController::class, 'createOrder']);
    Route::get('/{id}', [OrderController::class, 'getPaymentLinkInfoOfOrder']);
    Route::put('/{id}', [OrderController::class, 'cancelPaymentLinkOfOrder']);
});

Route::prefix('/payment')->group(function () { 
    Route::post('/payos', [PaymentController::class, 'handlePayOSWebhook']);
});
