<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Burger extends Model
{
    use HasFactory;

    protected $fillable = [
        'burger',
        'user_id',
        'burger_name'
    ];

    protected $casts = ['burger'=>'json'];

  
}