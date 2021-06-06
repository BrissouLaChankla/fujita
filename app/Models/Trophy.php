<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trophy extends Model
{
    protected $fillable = [
        'name', 
        'date_win',
        'podium',
        'logo_path',
    ];

    protected $dates = ['date_win'];
}
