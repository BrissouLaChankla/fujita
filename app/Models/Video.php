<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'name', 
        'game_id',
        'video_path'
    ];

    
    public function game() {
        return $this->belongsTo(Teamgame::class);
    }
    
}
