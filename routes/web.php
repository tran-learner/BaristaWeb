<?php

use App\Http\Controllers\DrinkController;
use App\Http\Controllers\IngredientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('initDrinkList');
});

Route::get('/drinks', [DrinkController::class,'getDrinks'])->name('initDrinkList');
Route::get('/ingredients', [IngredientController::class,'index'])->name('getIngredients');