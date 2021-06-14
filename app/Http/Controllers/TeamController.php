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
        $allgames = TeamGame::all();
        

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

            $me = Lol::find(1); 
            $days = array();


            foreach($me->mmrs as $mmr) {
                $days[] = $mmr->date_moment->format('d/m'); 
            }
      
        
        
        
        $chartdamages = [];
    
        $winlose = [$allgames->where('victory', 1)->count(),$allgames->where('victory', 0)->count()];

        
        
        $champions = json_decode(file_get_contents("http://ddragon.leagueoflegends.com/cdn/11.12.1/data/fr_FR/champion.json"), true);
        
        $infoDamages = [];
        foreach ($lols as $lol) {
            $infoDamages[$lol->player->firstname] = $lol->getTotalDamages();
        }
       arsort($infoDamages);

       $infoDeaths = [];
       foreach ($lols as $lol) {
           $infoDeaths[$lol->player->firstname] = $lol->getTotalDeaths();
       }
      arsort($infoDeaths);

      $infoVisions = [];
      foreach ($lols as $lol) {
          $infoVisions[$lol->player->firstname] = $lol->getTotalVisions();
      }
     arsort($infoVisions);
    //    dd(array_values($infoDamages)[0]);
    //    dd(array_keys($infoDamages)[0]);
        
        return view('team')->with([
            'topDamages' => ['name' => array_keys($infoDamages)[0], 'damages' => array_values($infoDamages)[0]],
            'topDeaths' => ['name' => array_keys($infoDeaths)[0], 'deaths' => array_values($infoDeaths)[0]],
            'topVisions' => ['name' => array_keys($infoVisions)[0], 'visions' => array_values($infoVisions)[0]],
            'chartdamages' => $chartdamages,
            'champions' => $champions,
            'lols'=> $lols,
            'winlose'=>$winlose,
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
