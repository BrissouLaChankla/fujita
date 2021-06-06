<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 
        'date_start', 
        'date_end', 
        'type', 
        'link', 
        'description', 
        'logo_path', 
    ];

    protected $dates = ['date_start', 'date_end'];
}
