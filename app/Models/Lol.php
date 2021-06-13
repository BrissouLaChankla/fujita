<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lol extends Model
{
    protected $fillable = [
        'pseudo', 
        'lvl',
        'hotstreak',
        'lp',
        'rank',
        'tier',
        'id_sum',
        'wins',
        'loses',
        'player_id'
    ];

    public function mmrs() {
        return $this->hasMany(Mmr::class);
    }

    public function teamgames()
    {
        return $this->belongsToMany(TeamGame::class);
    }

    public function player() {
        return $this->belongsTo(Player::class);
    }

}
