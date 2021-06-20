<?php

namespace App\Http\Controllers;

use App\Models\TeamGame;
use App\Models\TeamGame_Lol;
use Illuminate\Http\Request;
use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\Base\Definitions\Region;
use App\Models\Player;
use App\Models\Lol;

class TeamgameController extends Controller
{
  public function findTeamGames() {
      $api = new LeagueAPI([
          LeagueAPI::SET_KEY    => getenv('LOL_KEY'),
          LeagueAPI::SET_REGION => Region::EUROPE_WEST,
          ]);
          
          // 
          $team = Lol::all()->pluck('id_sum');

          $isItTeam =[];


          // Me sélectionne
          $player = Player::find(1);

          //Récupère mon historique
          $matchlist = $api->getMatchlistByAccount($player->lol->id_sum);
          
          // Loop through 15 derniers de mes matchs
          foreach (array_slice($matchlist->matches, 0, 30) as $match) {
              $game = $api->getMatch($match->gameId);
              
              //Vide le tableau et le reset
              unset($isItTeam);
              $isItTeam = array();
              //Loop through les participants de ce match
              foreach ($game->participantIdentities as $participant) {
                // Si l'ID du participant apparait dans le tableau "team" contenant nos ID, 
                if(in_array($participant->player->accountId, json_decode($team))) {

                  //ajoute à "isItTeam" l'id en question
                  array_push($isItTeam, $participant->player->accountId);
                }
              }
              // si à la fin du compte y'a 5 personnes dans le nouveau tableau, c'est un match de team
              if (count($isItTeam) == 5) {
                echo ("match de team détecté! <br>");
                $this->storeTeamGame($game, $team);
                $this->storeMatesGame($game, $team);
              } else {
    // dd($game);

                echo count($isItTeam). " joueurs de la team présent dans cette game<br>";
              }
          }
  }
  
  
  // Rentre dans cette fonction que si c'est une game qu'on a envie de récup
  
  public function storeTeamGame($game, $team) {
    // _________________________ STORE LA GAME _______________________________
    
    foreach ($game->participantIdentities as $participantIdent) {
      if ($participantIdent->player->accountId == "0xxSlrL4_1qQ_s12vVyI1WZzg5Jd8RruCLPHV5OjYoZkpw") {
        $myId = $participantIdent->getData()['participantId'];
      }
    }
    
    foreach ($game->participants as $participant) {
      if($participant->participantId == $myId) {
        $myTeamId = $participant->teamId;
      }
    }
    
    foreach ($game->teams as $team) {
      if ($team->teamId == $myTeamId) {
        if ($team->win == "Win") {
          $victory = 1;
        } else {
          $victory = 0;
        }
      }
    }
    // dd($game);
    $teamGame = TeamGame::firstOrCreate(
      ['game_id'=> $game->gameId],
      [
      'duree' => $game->gameDuration,
      'victory' => $victory, 
      ]);
  }
  
  public function storeMatesGame($game, $team) {
        // _________________________ STORE LES STATS DES MEMBRES _______________________________
    
        foreach ($game->participantIdentities as $participantIdent) {
          if (in_array($participantIdent->player->accountId, json_decode($team))) {
            // dd($game);
              foreach ($game->participants as $participant) {
                if($participantIdent->getData()['participantId'] == $participant->participantId) {
                  $teamgame_id = TeamGame::where('game_id', $game->gameId)->first()->id;
                  $lol_id = Lol::where('id_sum', $participantIdent->player->accountId)->first()->id;
                  // dd($participant->stats);
                  // dd($game);
                  $mvpScore = $this->calculateScoreMVP($participant->stats);
                  // dd($mvpScore);
                  $teamgame_lol = TeamGame_Lol::firstOrCreate([
                    'teamgame_id' => $teamgame_id,
                    'lol_id' => $lol_id,
                    'golds' => $participant->stats->goldEarned,
                    'damages' => $participant->stats->totalDamageDealtToChampions,
                    'champion' => $participant->championId,
                    'position' => $participant->timeline->lane,
                    'kills' => $participant->stats->kills,
                    'deaths' => $participant->stats->deaths,
                    'assists' => $participant->stats->assists,
                    'largestmultikill' => $participant->stats->largestMultiKill,
                    'wardsplaced' => $participant->stats->visionScore,
                    'cs' => ($participant->stats->totalMinionsKilled + $participant->stats->neutralMinionsKilled),
                  ], ['mvp' => $mvpScore]);


                }
              }
          }
        }
        
  }


  public function calculateScoreMVP($participant) {
    
    $mvpKills = ($participant->kills *2);
    $mvpDeaths = ($participant->deaths *(-2));
    $mvpAssists = ($participant->assists * 0.65);
    $mvpDamages = ($participant->totalDamageDealtToChampions * 0.0005);
    $mvpTanked = ($participant->totalDamageTaken * 0.0002);
    $mvpGolds = ($participant->goldEarned * 0.0003);
    $mvpVision = ($participant->visionScore * 0.28);
    $mvpCs = (($participant->totalMinionsKilled + $participant->neutralMinionsKilled) * 0.04);
    $helpSupport = 10; 

    $mvpScore = $mvpAssists + $mvpKills + $mvpDeaths + $mvpDamages + $mvpGolds + $mvpVision + $mvpCs + $mvpTanked + $helpSupport;

    return $mvpScore;
  }

}

// 0 => "5XKQuBcRS27_6mD4OPrJfcf336q9g47w_cpGmVt9o3Mwaw"
// 1 => "9V3ycnI7NJeGP7br32LVwHK8dQy9txxvJrDKLPk5PyBg0g"
// 2 => "u3fnh3y5o9MUFzb4fjDyeo18-pcic9e8WiQ8Nf2gmpmRIps"
// 3 => "XQUFRYb6ZGb0avres5YYkmHJrpmhdO4P9Isgm7WUxpRxiQA"
// 4 => "wtX33Vp4mUIiVuJQ7khu_hDBGPOJDcUkORzIxEujHadO0VI"
