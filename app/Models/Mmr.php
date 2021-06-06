<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mmr extends Model
{
    protected $fillable = [
        'date_moment', 
        'mmr_soloq',
        'mmr_flexq',
        'lol_id' 
    ];

    protected $dates = ['date_moment'];

    public function lol() {
        return $this->belongsTo(Lol::class);
    }
}
