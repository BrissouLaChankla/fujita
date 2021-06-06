<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'firstname', 
        'lasname',
        'slug',
        'birthday',
        'role', 
        'description', 
        'favchar_path', 
        'clip_path', 
        'lol_id' 
    ];

    protected $dates = ['birthday'];

    public function lol() {
        return $this->hasOne(Lol::class);
    }

}
