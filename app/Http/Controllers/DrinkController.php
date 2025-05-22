<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DrinkController extends Controller
{
    public function getDrinks(){
        // $drinks = config('drinks.drinkData')['drinks'];
        // return view('drinkList', compact('drinks'));
        $item = DB::select("SELECT * FROM drinkdata");
        return view('drinkList', compact('item'));
    }
}