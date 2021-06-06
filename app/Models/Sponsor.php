<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = [
        'name', 
        'link',
        'logo_path',
        'promo_code'
    ];
}
