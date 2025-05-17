<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Str;

class PostgresArrayString implements CastsAttributes
{
    /**
     * Cast the given value from the database.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value  // This will be the string like "{Coffee,Sugar}"
     * @param  array  $attributes
     * @return array|null
     */
    public function get($model, string $key, mixed $value, array $attributes): ?array
    {
        // If value is null or empty string, return empty array or null
        if (is_null($value) || $value === '{}') {
            return []; // Or return null if you prefer null for empty arrays
        }

        // Remove the outer braces {}
        $cleanedValue = trim($value, '{}');

        // Split the string by commas.
        // Note: This simple explode might not handle commas *within* quoted elements correctly.
        // If you have elements like "item with, comma", you might need a more robust parser
        // like using str_getcsv or a custom parsing function.
        $array = explode(',', $cleanedValue);

         // Optionally trim whitespace from each element
        $array = array_map('trim', $array);


        return $array;
    }

    /**
     * Cast the given value to the database.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array|null  $value // This will be the PHP array
     * @param  array  $attributes
     * @return string|null // Must return a string in the "{value1,value2}" format
     */
    public function set($model, string $key, mixed $value, array $attributes): ?string
    {
        // If value is null or empty array, return the PostgreSQL representation of an empty array
         if (is_null($value) || empty($value)) {
             return '{}';
         }

         // Ensure the value is an array (in case something unexpected is passed)
         if (!is_array($value)) {
             // Handle error or convert to array if possible
             // For this example, we'll assume it's an array
             return '{}'; // Or throw an exception
         }

        // Implode the array elements with commas and wrap in braces.
        // Note: Similar to 'get', this simple implode doesn't handle
        // adding quotes for elements that contain commas, braces, or quotes.
        // For more complex data, you'd need to correctly format each element
        // according to PostgreSQL array literal rules.
        $stringValue = '{' . implode(',', $value) . '}';

        return $stringValue;
    }
}