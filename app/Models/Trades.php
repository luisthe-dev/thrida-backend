<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trades extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'amount',
        'amount_won',
        'assets_id',
        'percentage_win',
        'entry_value',
        'exit_value',
        'status',
    ];
}
