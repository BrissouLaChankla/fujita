<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamGame_User;
use App\Models\TeamGame;
use App\Models\User;


class CommentaryController extends Controller
{
    public function addComment(Request $request) {
        $current = \Auth::user();
        
        return view('includes.addcommentary')->with([
            'gameid' => $request->gameid,
            'current' => $current
        ]);
        
    }
    
    public function postComment(Request $request) {
        Teamgame_User::UpdateOrCreate(
            ['teamgame_id' => $request->gameid,
             'user_id' => $request->userid
            ],
            [
                'commentary'=> $request->commentary
            ]
        );
    }
}
