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
        'cs','mvp');
    }


    public function MVP() {
        return $this->belongsToMany(Lol::class, 'teamgame_lol', 'teamgame_id')->withPivot('mvp')->orderBy('pivot_mvp', 'desc')->first(); 
    }

    public function getDamages() {
        $pseudos = [];
        $damages = [];
        $pseudoDamages = $this->belongsToMany(Lol::class, 'teamgame_lol', 'teamgame_id')->withPivot('damages')->pluck('teamgame_lol.damages', 'pseudo'); 
        foreach ($pseudoDamages as $pseudo => $damage) {
            $pseudos[] =  $pseudo;
            $damages[] = $damage;

        }
        return [$pseudos, $damages];
    }
    
    
}
