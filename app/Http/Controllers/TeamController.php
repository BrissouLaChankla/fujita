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
        $ddragonversion = json_decode(file_get_contents("https://ddragon.leagueoflegends.com/api/versions.json"), true)[0];

        $lols = Lol::all();
        $mmrs = Mmr::all();
        $allgames = TeamGame::with([
            'videos',
            'lols', 
            'MVP',
            'MVP.player'])->orderBy('created_at', 'desc')->get();
        
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
                        //Adrien
                    case 3:
                        $AzaSoloQ[] = $mmr->mmr_soloq;
                        $AzaFlexQ[] = $mmr->mmr_flexq;
                        break;
                        //Louis
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

            $me = Lol::find(1);
            foreach($me->mmrs as $mmr) {
                $days[] = $mmr->date_moment->format('d/m'); 
            }
      
        
        
        
        $chartdamages = [];
    
        $winlose = [$allgames->where('victory', 1)->count(),$allgames->where('victory', 0)->count()];

        
        
        $champions = json_decode(file_get_contents("http://ddragon.leagueoflegends.com/cdn/".$ddragonversion."/data/fr_FR/champion.json"), true);
        
        
        $averageStats = $this->getAverageStats();

        return view('team')->with([
            'chartdamages' => $chartdamages,
            'averageStats' => $averageStats,
            'champions' => $champions,
            'lols'=> $lols,
            'winlose'=>$winlose,
            'allgames' => $allgames,
            'ddragonversion' => $ddragonversion,
            
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
    
    
    public function getAverageStats() {
            
        $participationsGames = TeamGame_Lol::all();
        $averageStats = [];
    
            foreach ($participationsGames as $participationGame) {
                switch ($participationGame->lol_id) {
                    case 1:
                        $briceAllDamages[] = $participationGame->damages; 
                        $briceAllDeaths[] = $participationGame->deaths; 
                        $briceAllVisions[] = $participationGame->visionscore; 
                    break;
                    case 2:
                        $clementAllDamages[] = $participationGame->damages; 
                        $clementAllDeaths[] = $participationGame->deaths; 
                        $clementAllVisions[] = $participationGame->visionscore; 
                    break;
                    case 3:
                        $adrienAllDamages[] = $participationGame->damages; 
                        $adrienAllDeaths[] = $participationGame->deaths; 
                        $adrienAllVisions[] = $participationGame->visionscore; 
                    break;
                    case 4:
                        $louisAllDamages[] = $participationGame->damages; 
                        $louisAllDeaths[] = $participationGame->deaths; 
                        $louisAllVisions[] = $participationGame->visionscore; 
                    break;
                    case 5:
                        $sachaAllDamages[] = $participationGame->damages; 
                        $sachaAllDeaths[] = $participationGame->deaths; 
                        $sachaAllVisions[] = $participationGame->visionscore; 
                    break;
                    }
                }
                $averageStats = [
                    "damages" => [
                        "Brice" => array_sum($briceAllDamages) / count($briceAllDamages),
                        "Clément" => array_sum($clementAllDamages) / count($clementAllDamages),
                        "Adrien" =>  array_sum($adrienAllDamages) / count($adrienAllDamages),
                        "Louis" => array_sum($louisAllDamages) / count($louisAllDamages),
                        "Sacha" => array_sum($sachaAllDamages) / count($sachaAllDamages)
                    ],
                    "deaths" => [
                        "Brice" => array_sum($briceAllDeaths) / count($briceAllDeaths),
                        "Clément" => array_sum($clementAllDeaths) / count($clementAllDeaths),
                        "Adrien" =>  array_sum($adrienAllDeaths) / count($adrienAllDeaths),
                        "Louis" => array_sum($louisAllDeaths) / count($louisAllDeaths),
                        "Sacha" => array_sum($sachaAllDeaths) / count($sachaAllDeaths)
                    ],
                    "visions" => [
                        "Brice" => array_sum($briceAllVisions) / count($briceAllVisions),
                        "Clément" => array_sum($clementAllVisions) / count($clementAllVisions),
                        "Adrien" =>  array_sum($adrienAllVisions) / count($adrienAllVisions),
                        "Louis" => array_sum($louisAllVisions) / count($louisAllVisions),
                        "Sacha" => array_sum($sachaAllVisions) / count($sachaAllVisions)
                        ]
                    ];
                    
                    arsort($averageStats["damages"]);
                    arsort($averageStats["deaths"]);
                    arsort($averageStats["visions"]);
                    
                    return $averageStats;
    }
}
