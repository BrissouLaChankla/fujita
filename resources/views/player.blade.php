@extends('layouts.app')

@section('content')

<div class="text-white">
   
<div class="container">
    <img src="http://ddragon.leagueoflegends.com/cdn/{{$ddragonversion}}/img/profileicon/{{$summoner->profileIconId}}.png" style="width:100px" alt="">
    <h2 class="text-uppercase text-success">
        {{$player->firstname}} {{substr($player->lastname, 0, 1)}}.
    </h2>
    <h1 class="text-white font-weight-bold pseudo">
        {{$summoner->name}}
    </h1>
    <div class="row">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="player-label">Age</h3>
                    <h4 class="player-value">{{
                        \Carbon\Carbon::parse($player->birthday)->diff(\Carbon\Carbon::now())->y
                        }} ans</h4>
                </div>
                <div class="col-md-4">
                    <h3 class="player-label">Rôle</h3>
                    <h4 class="player-value">{{$player->role}}</h4>
                </div>
                <div class="col-md-4">
                    <h3 class="player-label">Niveau</h3>
                    <h4 class="player-value">
                        {{$summoner->summonerLevel}}

                      
                        </h4>
                </div>
                <div class="col-md-6">
                    <h3 class="player-label">FlexQ Stat</h3>
                    <h4 class="player-value"><span class="text-success">{{$flexStat->wins}}</span>/<span class="text-danger">{{$flexStat->losses}}</span> | {{number_format((float)($flexStat->wins / ($flexStat->wins + $flexStat->losses)*100), 2, '.', '')}}%</h4>
                    <img src="{{asset('emblems/Emblem_'.$flexStat->tier.'.png')}}" style="width:65px" alt="">
                    {{$flexStat->tier}}
                    {{$flexStat->rank}}
                </div>
                <div class="col-md-6">
                    <h3 class="player-label">SoloQ Stat</h3>
                    <h4 class="player-value"><span class="text-success">{{$soloStat->wins}}</span>/<span class="text-danger">{{$soloStat->losses}}</span> | {{number_format((float)($soloStat->wins / ($soloStat->wins + $soloStat->losses)*100), 2, '.', '')}}%</h4>
                    <img src="{{asset('emblems/Emblem_'.$soloStat->tier.'.png')}}" style="width:65px" alt="">
                    {{$soloStat->tier}}
                    {{$soloStat->rank}}
                
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <img src="{{$player->favchar_path}}" class="img-fluid" alt="">
        </div>
    </div>
</div>



    

    {{-- @foreach ($stats as $stat)
        {{$stat->leaguePoints}}

        {{$stat->hotStreak}}
    @endforeach --}}
</div>

@endsection