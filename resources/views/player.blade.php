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
                    <img src="{{asset('/emblems/Emblem_'.ucfirst(strtolower($flexStat->tier)).'.png')}}" style="width:65px" alt="">
                    {{$flexStat->tier}}
                    {{$flexStat->rank}}
                    {{$flexStat->leaguePoints}} lp
                    <hr>
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header">Elo flexQ</div>
                        <div class="card-body">
                            <canvas id="chartFlexQ"></canvas>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <h3 class="player-label">SoloQ Stat</h3>
                    <h4 class="player-value"><span class="text-success">{{$soloStat->wins}}</span>/<span class="text-danger">{{$soloStat->losses}}</span> | {{number_format((float)($soloStat->wins / ($soloStat->wins + $soloStat->losses)*100), 2, '.', '')}}%</h4>
                    <img src="{{asset('/emblems/Emblem_'.ucfirst(strtolower($soloStat->tier)).'.png')}}" style="width:65px" alt="">
                    {{$soloStat->tier}}
                    {{$soloStat->rank}}
                    {{$soloStat->leaguePoints}} lp

                    <hr>
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header">Elo soloQ</div>
                        <div class="card-body">
                            <canvas id="chartSoloQ"></canvas>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <img src="{{$player->favchar_path}}" class="img-fluid" alt="">
        </div>
    </div>
</div>

    <script>
            var ctx = document.getElementById('chartSoloQ').getContext('2d');
            var ctx2 = document.getElementById('chartFlexQ').getContext('2d');
        
        
            var chartSoloQ = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! $days !!},
                datasets: [{
                    tension: 0.3,
                    data: {!! $allSoloStats !!},
                    borderColor: "orange",
                    backgroundColor : "orange"
                }]

            },
            options: {
                plugins: {
                    legend: {
                        display: false,
                        
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'nearest',
                },
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
        
        var chartFlexQ = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: {!! $days !!},
                datasets: [{
                    tension: 0.3,
                    data: {!! $allFlexStats !!},
                    borderColor: "orange",
                    backgroundColor : "orange"
                }]

            },
            options: {
                plugins: {
                    legend: {
                        display: false,
                        
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'nearest',
                },
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
        
        
    </script>
    

    {{-- @foreach ($stats as $stat)
        {{$stat->leaguePoints}}

        {{$stat->hotStreak}}
    @endforeach --}}
</div>

@endsection