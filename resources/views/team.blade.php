@extends('layouts.app')

@section('content')

    <div class="container bg-light">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Elo SoloQ</h5>
                        <canvas id="chartSoloQ"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Elo FlexQ</h5>
                        <canvas id="chartFlexQ"></canvas>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($allgames as $key=>$game)
        <h2 class="text-center mt-3 text-uppercase">
            @if ($game->victory == 1)
                <strong class="text-success"> Victoire </strong>
            @else 
                <strong class="text-danger"> Défaite </strong>
            @endif
        </h2>
        <div class="row">
            <div class="col-2">
                <img src="{{asset('mvp/brice.jpg')}}" class="img-fluid" alt="MVP">
            </div>
            <div class="col-8">
                <ul>
                    @foreach ($game->lols as $lol)
                    <div class="d-flex">
                        <div>
                            @foreach ($champions["data"] as $champ)
                                @switch($champ["key"])
                                    @case($lol->pivot->champion)
                                        <img src="http://ddragon.leagueoflegends.com/cdn/11.12.1/img/champion/{{$champ['id']}}.png" class="champ-used" alt="">
                                        @break
                                    @default
                                @endswitch
                            @endforeach
                        </div>
                        <div>
                            {{$lol->pseudo}}
                        </div>
                        <div class="golds">
                            <i class="fas fa-coins"></i> {{$lol->pivot->golds}}                
                        </div>
                        <div class="damages">
                            <i class="fas fa-bomb"></i> {{$lol->pivot->damages}}                
                        </div>
                        <div>
                            <img src="{{asset('positions/Position_Diamond-'.ucfirst(strtolower($lol->pivot->position)).'.png')}}" alt="">
                        </div>
                        <div>
                            <strong class="text-success">
                            {{$lol->pivot->kills}}               
                            </strong> /  
                            <strong class="text-danger">
                                {{$lol->pivot->deaths}}              
                            </strong> / 
                            <strong class="text-warning">
                                {{$lol->pivot->assists}}                
                            </strong>
                        </div>
                        <div>
                            {{$lol->pivot->wardsplaced}} score de vision               
                        </div>
                        <div>
                            {{$lol->pivot->cs}}cs                
                        </div>
                   
                    </div>
                    @endforeach
                </ul>
            </div>
        </div>
    
    @endforeach

    </div>
    <script>
        var ctx = document.getElementById('chartSoloQ').getContext('2d');
        var ctx2 = document.getElementById('chartFlexQ').getContext('2d');

        var chartSoloQ = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! $days !!},
                datasets: [{
                    tension: 0.1,
                    label: "Prépuce Endolori",
                    data: {!! $BriceSoloQ !!},
                    borderColor: "orange",
                    backgroundColor : "orange"
                }, {
                    tension: 0.1,
                    label: "Bepo",
                    data: {!! $BepoSoloQ !!},
                    borderColor: "lightblue",
                    backgroundColor : "lightblue"
                }, {
                    tension: 0.1,
                    label: "Lbrs7",
                    data: {!! $LouisSoloQ !!},
                    borderColor: "lightgreen",
                    backgroundColor : "lightgreen"
                }, {
                    tension: 0.1,
                    label: "Azakatana",
                    data: {!! $AzaSoloQ !!},
                    borderColor: "lightpink",
                    backgroundColor : "lightpink"
                }, {
                    tension: 0.1,
                    label: "Youmel",
                    data: {!! $YoumelSoloQ !!},
                    borderColor: "lightcoral",
                    backgroundColor : "lightcoral"
                }]

            },
            options: {
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
                    tension: 0.1,
                    label: "Prépuce Endolori",
                    data: {!! $BriceFlexQ !!},
                    borderColor: "orange",
                    backgroundColor : "orange"
                    
                }, {
                    tension: 0.1,
                    label: "Bepo",
                    data: {!! $BepoFlexQ !!},
                    borderColor: "lightblue",
                    backgroundColor : "lightblue"
                    
                    
                }, {
                    tension: 0.1,
                    label: "Lbrs7",
                    data: {!! $LouisFlexQ !!},
                    borderColor: "lightgreen",
                    backgroundColor : "lightgreen"
                    
                    
                }, {
                    tension: 0.1,
                    label: "Azakatana",
                    data: {!! $AzaFlexQ !!},
                    borderColor: "lightpink",
                    backgroundColor : "lightpink"
                    
                }, {
                    tension: 0.1,
                    label: "Youmel",
                    data: {!! $YoumelFlexQ !!},
                    borderColor: "lightcoral",
                    backgroundColor : "lightcoral"
                    
                }]

            },
            options: {
                interaction: {
                    intersect: false,
                    mode: 'nearest',
                },
                scales: {
                    y: {
                        beginAtZero: false
                    }
                },
                plugins: {
                    autocolors: false,
                    annotation: {
                        annotations: {
                            line1: {
                                type: 'line',
                                yMin: 1500,
                                yMax: 1620,
                                borderColor: 'rgb(255, 99, 132)',
                                borderWidth: 2,
                            }
                        }
                    }
                }
            }
        });



    </script>
@endsection
