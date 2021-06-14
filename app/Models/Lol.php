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
        return $this->belongsToMany(TeamGame::class, 'teamgame_lol', 'teamgame_id', 'lol_id');
    }

    public function player() {
        return $this->belongsTo(Player::class);
    }

    public function getTotalDamages() {
        $storeTotalDamages = [];
        foreach ($this->teamgames as $game) {
            foreach($game->lols as $lol) {
                if($lol->id_sum == $this->id_sum) {
                    $storeTotalDamages[] = $lol->pivot->damages;                    
                }
            }
        }

        $totalDamages = array_sum($storeTotalDamages);
        $averageDamages = array_sum($storeTotalDamages) / count($storeTotalDamages);
        return $averageDamages;
    }

    public function getTotalDeaths() {
        $storeTotalDeaths = [];
        
        foreach ($this->teamgames as $game) {
            foreach($game->lols as $lol) {
                if($lol->id_sum == $this->id_sum) {
                    $storeTotalDeaths[] = $lol->pivot->deaths;                    
                }
            }
        }

        $totalDeaths = array_sum($storeTotalDeaths);
        $averageDeaths = array_sum($storeTotalDeaths) / count($storeTotalDeaths);
        return $averageDeaths;
    }

    public function getTotalVisions() {
        $storeTotalVisions = [];
        
        foreach ($this->teamgames as $game) {
            foreach($game->lols as $lol) {
                if($lol->id_sum == $this->id_sum) {
                    $storeTotalVisions[] = $lol->pivot->wardsplaced;                    
                }
            }
        }

        $totalVisions = array_sum($storeTotalVisions);
        $averageVisions = array_sum($storeTotalVisions) / count($storeTotalVisions);
        return $averageVisions;
    }

    

}
