<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drlist extends Model
{
    use HasFactory;

    // If your table is 'your_schema.your_table'
    protected $connection = 'supabase';
    protected $table = 'DRINK_DATA'; // Specify schema and table

}

class Order extends Model
{
    protected $connection = 'supabase';
    protected $table = "ORDERS";
    protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'string'; // or 'int' if you're using another PK
    protected $fillable = [
        'drink',
        'price',
        'Ordercode',
        'ordered_time'
    ];

    public $timestamps = false;
}
