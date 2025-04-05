<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DrinkController extends Controller
{
    public function getDrinks(){
        $drinks = config('drinks.drinkData')['drinks'];
        return view('drinkList', compact('drinks'));
    }
}
