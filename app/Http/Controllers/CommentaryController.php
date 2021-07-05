<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamGame_User;
use App\Models\TeamGame;
use App\Models\User;


class CommentaryController extends Controller
{
    public function addComment() {
        
        return view('includes.addcommentary');
    }
    
    public function postComment() {
        
    }
}
