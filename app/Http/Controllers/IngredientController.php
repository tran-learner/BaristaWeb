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
        // Use correct column name casing "imagePath" (assuming this is the column name)
        $imagePath = $drinkDetails->imagePath;
        $ingredientsString = $drinkDetails->ingredients; // Get the string value
        $price = $drinkDetails->price;

        // --- Start: Convert the ingredients string to an array ---

        $ingredients = []; // Initialize an empty array for ingredients

        // Check if the ingredients string is not null and not an empty PostgreSQL array string "{}"
        if (!empty($ingredientsString) && $ingredientsString !== '{}') {
            // Remove the curly braces from the start and end of the string
            $cleanedIngredientsString = trim($ingredientsString, '{}');

            // Split the string by commas to get individual ingredients
            // Note: This simple explode works if ingredients don't contain commas themselves.
            // For more complex cases, you might need a more robust parsing method.
            $ingredients = explode(',', $cleanedIngredientsString);

            // Optional: Trim whitespace from each ingredient
            $ingredients = array_map('trim', $ingredients);
        }

        // --- End: Convert the ingredients string to an array ---


        // Pass the data to the view
        // $ingredients is now a PHP array
        return view("ingredientPage", compact('ingredients', 'drink', 'price', 'imagePath'));
    }
}