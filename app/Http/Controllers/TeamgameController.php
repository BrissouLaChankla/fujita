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
          LeagueAPI::SET_KEY    => "RGAPI-9a45f100-2542-4c72-99e2-bcee24401969",
          LeagueAPI::SET_REGION => Region::EUROPE_WEST,
          ]);
          
          // 
          $team = Lol::all()->pluck('id_sum');

          $isItTeam = array();


          // Me sélectionne
          $player = Player::find(1);

          //Récupère mon historique
          $matchlist = $api->getMatchlistByAccount($player->lol->id_sum);
          
          // Loop through 15 derniers de mes matchs
          foreach (array_slice($matchlist->matches, 0, 15) as $match) {
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
                var_dump("match de team");
              } else {
                $this->storeTeamGame($game, $team);
                
                echo count($isItTeam). " joueurs de la team présent dans cette game<br>";
              }
          }
  }
  
  public function storeTeamGame($game, $team) {
    // dd($game);
    foreach ($game->participants as $participant) {
      dd($participant);
    }
    // 5XKQuBcRS27_6mD4OPrJfcf336q9g47w_cpGmVt9o3Mwaw
    foreach($team as $member) {
      dd($member);
    }

    $teamGame = TeamGame::firstOrCreate(
      ['game_id'=> $game->gameId],
      [
      'duree' => $game->gameDuration,
      'victory' => $allMMR[1], 
      ]);
  
  }
}
