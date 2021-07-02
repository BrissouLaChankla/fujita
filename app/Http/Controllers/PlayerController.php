<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Lol;
use App\Models\Mmr;
use App\Models\TeamGame;
use App\Models\TeamGame_Lol;

use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\Base\Definitions\Region;




class PlayerController extends Controller
{
    public function index($slug) {
        
        $api = new LeagueAPI([
            LeagueAPI::SET_KEY    => getenv('LOL_KEY'),
            LeagueAPI::SET_REGION => Region::EUROPE_WEST,
        ]);

        $player = Player::where('slug', $slug)->first();
        $summoner = $api->getSummonerByAccountId($player->lol->id_sum);
        $stats = $api->getLeagueEntriesForSummoner($summoner->id);
        foreach ($stats as $stat) {
            if ($stat->queueType == "RANKED_FLEX_SR") {
                $flexStat = $stat;
            } elseif($stat->queueType == "RANKED_SOLO_5x5") {
                $soloStat = $stat;
            } else {
                echo "Error";
            }
        }

        $ddragonversion = json_decode(file_get_contents("https://ddragon.leagueoflegends.com/api/versions.json"), true)[0];
        $days = [];
        $allSoloStats = [];
        $allFlexStats = [];
        
        foreach ($player->lol->mmrs as $mmr) {
            $days[] = $mmr->date_moment->format('d/m');
            $allSoloStats[] = $mmr->mmr_soloq;
            $allFlexStats[] = $mmr->mmr_flexq;
        }
        
        
        return view('player')->with([
            'player' => $player,
            'days' => json_encode($days),
            'ddragonversion' => $ddragonversion,
            'summoner' => $summoner,
            'flexStat' => $flexStat,
            'soloStat' => $soloStat,
            'allSoloStats' => json_encode($allSoloStats),
            'allFlexStats' => json_encode($allFlexStats)
        ]);
    }

    public function getMvpProfile(Request $request) {
        // Lol::find($request->lol_id);
        // TeamGame::find($request->teamgame_id);
        $mvpPlayer = TeamGame_Lol::where('lol_id', $request->lol_id)->where('teamgame_id', $request->teamgame_id)->first();
        return view('includes.contentModalMvp')->with([
            'player' => $mvpPlayer,
        ]);
    }


}

