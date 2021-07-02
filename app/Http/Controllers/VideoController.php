<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    
    
    public function videoUpload(Request $request) {
        
        //Store dans le dossier
        $video = $request->file('file');
        $videoName = time(). '.' . $video->extension();
        $video->move(public_path('video/moments_forts'), $videoName);
        
        //Store en BDD
        $video = Video::create([
            'name' => $videoName,
            'game_id' => $request->gameId,
            'video_path' => "video/moments_forts"
        ]);
        
        //Créer la miniature 
        $thumbnails = new FFMPEG;
        $thumbnails->getThumbnails($videoName, 'thumbnails', 5);
        
        
        return response()->json(['success'=>$videoName]);
        
        
        
    }
}
