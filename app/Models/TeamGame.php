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

    public function lols()
    {
        return $this->belongsToMany(Lol::class, 'teamgame_lol', 'teamgame_id')->withPivot( 'teamgame_id', 
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
        'cs',);
    }

    
}
