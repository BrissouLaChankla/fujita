<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamGame extends Model
{
    
    protected $table = 'teamgames';
    
    protected $fillable = [
        'game_id', 
        'duree',
        'victory',
        'type'
    ];
}
