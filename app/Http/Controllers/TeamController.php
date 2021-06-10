<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lol;
use App\Models\Mmr;
use App\Models\TeamGame;
use App\Models\TeamGame_Lol;

class TeamController extends Controller
{
    
    public function index() {

        $lols = Lol::all();
        $mmrs = Mmr::all();


        $BriceSoloQ = array();
        $BriceFlexQ = array();
        $AzaSoloQ = array();
        $AzaFlexQ = array();
        $LouisSoloQ = array();
        $LouisFlexQ = array();
        $BepoSoloQ = array();
        $BepoFlexQ = array();
        $YoumelSoloQ = array();
        $YoumelFlexQ = array();

            foreach($mmrs as $mmr) {
                switch ($mmr->lol_id) {
                        //Prépuce
                    case 1:
                        $BriceSoloQ[] = $mmr->mmr_soloq;
                        $BriceFlexQ[] = $mmr->mmr_flexq;
                        break;
                        //Bepo
                    case 2:
                        $BepoSoloQ[] = $mmr->mmr_soloq;
                        $BepoFlexQ[] = $mmr->mmr_flexq;
                        break;
                        //Louis
                    case 3:
                        $AzaSoloQ[] = $mmr->mmr_soloq;
                        $AzaFlexQ[] = $mmr->mmr_flexq;
                        break;
                        //Adrien
                        case 4:
                        $LouisSoloQ[] = $mmr->mmr_soloq;
                        $LouisFlexQ[] = $mmr->mmr_flexq;
                        break;
                        //Youmel
                    case 5:
                        $YoumelSoloQ[] = $mmr->mmr_soloq;
                        $YoumelFlexQ[] = $mmr->mmr_flexq;
                        break;
                };
            }


        $days = array();
      
        
        
        
        $allgames = TeamGame::all();
        $chartdamages = [];
    
        // foreach ($allgames as $game) {
        //     foreach($game->lols as $lol) {
        //         $chartdamages[
              
        //         ];
        //     }  
        // }
        
        
        $champions = json_decode(file_get_contents("http://ddragon.leagueoflegends.com/cdn/11.12.1/data/fr_FR/champion.json"), true);
        return view('team')->with([
            'chartdamages' => $chartdamages,
            'champions' => $champions,
            'lols'=> $lols,
            'allgames' => $allgames,
            'days'=> json_encode($days),
            'BriceSoloQ' => json_encode($BriceSoloQ),
            'BriceFlexQ' => json_encode($BriceFlexQ),
            'AzaSoloQ' => json_encode($AzaSoloQ),
            'AzaFlexQ' => json_encode($AzaFlexQ),
            'LouisSoloQ' =>json_encode($LouisSoloQ),
            'LouisFlexQ' => json_encode($LouisFlexQ),
            'BepoSoloQ' => json_encode($BepoSoloQ),
            'BepoFlexQ' => json_encode($BepoFlexQ),
            'YoumelSoloQ' => json_encode($YoumelSoloQ),
            'YoumelFlexQ' =>json_encode($YoumelFlexQ)

        ]);
    }
}
