<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Make sure DB facade is imported

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        $drink = $request->query('drink');

        // Fetch the specific drink data from the 'drinkdata' table
        // Filter by 'drink_name' and limit to 1
        // Use parameterized query for safety
        $drinkData = DB::select('SELECT "imagePath", ingredients, price FROM drinkdata WHERE drink_name = ? LIMIT 1', [$drink]);

        // DB::select returns an array of objects. Get the first object or null.
        $drinkDetails = $drinkData[0] ?? null;

        // Check if a drink was found based on the query result
        if (!$drinkDetails) {
            abort(404, 'Drink not found');
        }

        // Access properties using -> instead of []
        // Use correct column name casing "ImagePath"
        $imagePath = $drinkDetails->imagePath;
        $ingredients = $drinkDetails->ingredients;
        // Wrap price in an array to match view's expected usage ($price[0])
        $price = $drinkDetails->price;

        // Pass the data to the view
        // Pass the original $drink variable to the view if needed
        return view("ingredientPage", compact('ingredients', 'drink', 'price', 'imagePath'));
    }
}
