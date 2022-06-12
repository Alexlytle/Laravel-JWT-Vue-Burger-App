<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmitBuger extends Model
{
    use HasFactory;
    protected $fillable = ['city','zip','phone','name','email','burger_data'];
    protected $casts = ['burger_data'=>'json'];
}
