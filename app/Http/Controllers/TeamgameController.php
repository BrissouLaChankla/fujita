<?php

namespace App\Http\Controllers;

use App\TeamGame;
use Illuminate\Http\Request;
use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\Base\Definitions\Region;
use App\Models\Player;
use App\Models\Lol;

class TeamgameController extends Controller
{
  public function storeGames() {
      $api = new LeagueAPI([
          LeagueAPI::SET_KEY    => "RGAPI-fbef77f0-7049-4368-9f1e-79753caf9adf",
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
                dd("match de team");
              } else {
                dd($isItTeam);
              }
          }

  }
}
