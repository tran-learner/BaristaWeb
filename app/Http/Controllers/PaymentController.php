<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request){
        $drink = $request->query('drink');
        $drinks = config('drinks.drinkData')['drinks'];
        $drinkName = collect($drinks)->firstWhere('name', $drink);
        if (!$drinkName){ abort(404, 'Drink not found');}
        return view("ingredientPage",compact('ingredients','drink'));
    }
}