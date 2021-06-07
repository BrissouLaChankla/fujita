<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Lol;
use App\Models\Mmr;

use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\Base\Definitions\Region;




class PlayerController extends Controller
{
    public function index($slug) {
        
        $api = new LeagueAPI([
            LeagueAPI::SET_KEY    => "RGAPI-fbef77f0-7049-4368-9f1e-79753caf9adf",
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

        $ddragonversion = json_decode(file_get_contents("https://ddragon.leagueoflegends.com/api/versions.json"), true);
        
        
        return view('player')->with([
            'player' => $player,
            'ddragonversion' => $ddragonversion[0],
            'summoner' => $summoner,
            'flexStat' => $flexStat,
            'soloStat' => $soloStat
        ]);
    }




}

