<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sendtoDB extends Model
{
    protected $connection = 'supabase'; // use Supabase connection
    protected $table = 'users';
    protected $fillable = ['name', 'email']; // match your columns
    public $timestamps = false; // or true if your table uses timestamp
}
