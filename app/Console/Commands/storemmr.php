<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

use App\Models\Player;
use App\Models\Lol;
use App\Models\Mmr;

use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\Base\Definitions\Region;

use Session;

class storemmr extends Command
{
    /**
        
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storemmr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Store le MMR actuel des joueurs";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lols = Lol::all();
        foreach ($lols as $lol) {
            $allMMR = $this->getTotalSoloQMMR($lol->id_sum);
            $mmr = Mmr::updateOrCreate(
                ['date_moment'=>now()->setTime(00,00,00),
                'lol_id' => $lol->id],
                [
                'mmr_soloq' => $allMMR[0],
                'mmr_flexq' => $allMMR[1], 
                ]);
        }
    }

    public function getTotalSoloQMMR($summonerid) {
        $api = new LeagueAPI([
            LeagueAPI::SET_KEY    => getenv('LOL_KEY'),
            LeagueAPI::SET_REGION => Region::EUROPE_WEST,
        ]);

        $summoner = $api->getSummonerByAccountId($summonerid);
        $stats = $api->getLeagueEntriesForSummoner($summoner->id);

        foreach ($stats as $stat) {
            if ($stat->queueType == "RANKED_SOLO_5x5") {
                switch ($stat->tier) {
                    case "IRON":
                        $tiermmrsolo = 0;
                        break;
                    case "BRONZE":
                        $tiermmrsolo = 400;
                        break;
                    case "SILVER":
                        $tiermmrsolo = 800;
                        break;
                    case "GOLD":
                        $tiermmrsolo = 1200;
                        break;
                    case "PLATINUM":
                        $tiermmrsolo = 1600;
                        break;
                    case "DIAMOND":
                        $tiermmrsolo = 2000;
                        break;
                    case "MASTER":
                        $tiermmrsolo = 2400;
                        break;
                };
        
                switch ($stat->rank) {
                    case "I":
                        $rankmmrsolo = 300;
                        break;
                    case "II":
                        $rankmmrsolo = 200;
                        break;
                    case "III":
                        $rankmmrsolo = 100;
                        break;
                    case "IV":
                        $rankmmrsolo = 0;
                        break;
                };
        
                $lpmmrsolo = $stat->leaguePoints;

            } elseif ($stat->queueType == "RANKED_FLEX_SR") {
                switch ($stat->tier) {
                    case "IRON":
                        $tiermmrflex = 0;
                        break;
                    case "BRONZE":
                        $tiermmrflex = 400;
                        break;
                    case "SILVER":
                        $tiermmrflex = 800;
                        break;
                    case "GOLD":
                        $tiermmrflex = 1200;
                        break;
                    case "PLATINUM":
                        $tiermmrflex = 1600;
                        break;
                    case "DIAMOND":
                        $tiermmrflex = 2000;
                        break;
                    case "MASTER":
                        $tiermmrflex = 2400;
                        break;
                };
        
                switch ($stat->rank) {
                    case "I":
                        $rankmmrflex = 300;
                        break;
                    case "II":
                        $rankmmrflex = 200;
                        break;
                    case "III":
                        $rankmmrflex = 100;
                        break;
                    case "IV":
                        $rankmmrflex = 0;
                        break;
                };
        
                $lpmmrflex = $stat->leaguePoints;
            } else {
                echo "bug";
            }
        }

        $mmrflex = $rankmmrflex + $tiermmrflex + $lpmmrflex;
        $mmrsolo = $rankmmrsolo + $tiermmrsolo + $lpmmrsolo;
        return [$mmrsolo, $mmrflex];
    }

}