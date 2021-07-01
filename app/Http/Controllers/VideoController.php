<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    
    
    public function videoUpload(Request $request) {
        $video = $request->file('file');
        $videoName = time(). '.' . $video->extension();
        $video->move(public_path('video/moments_forts'), $videoName);
        
        
        $video = Video::create([
            'name' => $videoName,
            'game_id' => $request->gameId,
            'video_path' => "video/moments_forts"
        ]);
        
        return response()->json(['success'=>$videoName]);
        
        
        
    }
}
