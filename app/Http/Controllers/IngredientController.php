<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index(Request $request){
        $drink = $request->query('drink');
        $drinks = config('drinks.drinkData')['drinks'];
        $drinkName = collect($drinks)->firstWhere('name', $drink);
        if (!$drinkName){ abort(404, 'Drink not found');}
        $ingredients = $drinkName['ingredients'];
        return view("ingredientPage",compact('ingredients','drink'));
    }
}
