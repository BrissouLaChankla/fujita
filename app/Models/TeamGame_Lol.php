<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamGame_Lol extends Model
{
    protected $table = 'teamgame_lol';
    
    protected $fillable = [
        'teamgame_id', 
        'lol_id',
        'golds',
        'damages',
        'champion',
        'position',
        'kills',
        'deaths',
        'assists',
        'largestmultikill',
        'wardsplaced',
        'cs',
        'mvp'
    ];

}
