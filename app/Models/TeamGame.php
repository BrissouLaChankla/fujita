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
        'cs','mvp')->orderBy('order_histo', 'asc');
    }


    public function users() {
        $this->belongsToMany(User::class,'teamgame_user', 'teamgame_id')->withPivot('commentary')->withTimestamps();
    }

    
    public function MVP() {
        return $this->lols()->reorder()->orderBy('mvp', 'desc');
    }

    public function getDamages() {
        $pseudos = [];
        $damages = [];
        $pseudoDamages = $this->lols->pluck('pivot.damages', 'pseudo'); 
        foreach ($pseudoDamages as $pseudo => $damage) {
            $pseudos[] =  $pseudo;
            $damages[] = $damage;

        }
        return [$pseudos, $damages];
    }
    
    
    public function videos() {
        return $this->hasMany(Video::class, 'game_id');
    }


    public function commentaires() {
        return $this->hasMany(TeamGame_User::class, 'teamgame_id');
    }
}
