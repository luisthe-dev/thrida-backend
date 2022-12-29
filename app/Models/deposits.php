<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deposits extends Model
{
    use HasFactory;

    protected $fillable = [
        'deposit_method',
        'min_amount',
        'max_amount',
        'deposit_details',
        'deposit_image',
        'deposit_logo',
        'no_of_uses'
    ];
}
