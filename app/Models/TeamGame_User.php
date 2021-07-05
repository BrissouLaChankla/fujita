<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamGame_User extends Model
{
    protected $table = 'teamgame_user';
    
    protected $fillable = [
        'teamgame_id', 
        'user_id',
        'commentary'
    ];

}
