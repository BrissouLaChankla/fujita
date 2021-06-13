@extends('layouts.app')

@section('content')
    <div class="container bg-color p-3 rounded shadow">
        <h2 class="text-white text-center">Classements</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-clearer">
                    <div class="card-body">
                        <h5 class="card-title text-white text-center">Elo SoloQ</h5>
                        <canvas id="chartSoloQ"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-clearer">
                    <div class="card-body">
                        <h5 class="card-title text-white text-center">Elo FlexQ</h5>
                        <canvas id="chartFlexQ"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3 rounded shadow">
        <div class="row">
            <div class="col-3">
                
            </div>
            <div class="col-3">

            </div>
            <div class="col-3">

            </div>
            <div class="col-3">

            </div>

        </div>
    </div>


    <div class="container bg-color p-md-5 mt-3 rounded shadow">
        <h1><strong class="text-success">{{$winlose[0]}} wins</strong> / <strong class="text-danger">{{$winlose[1]}} losses</strong></h1>

        @foreach ($allgames as $key => $game)
            <h2 class="text-center mt-3 text-uppercase">
                @if ($game->victory == 1)
                    <strong class="color-win"> Victoire </strong>
            </h2>
            <div class="row align-items-center position-relative p-3 rounded shadow bg-win">
            @else
                <strong class="color-lose"> Défaite </strong>
                </h2>
                <div class="row align-items-center position-relative p-3 rounded shadow bg-lose">
        @endif
        <div class="duree p-2 rounded">
            <i class="far fa-clock"></i> {{
                gmdate("i:s", $game->duree)
                }}
        </div>
        <div class="col-2">
            <div>
                <img src="{{ asset('mvp/'.strtolower($game->MVP()->player->firstname).'.jpg') }}" class="img-fluid rounded shadow-sm" alt="MVP">
                <img src="{{ asset('mvp/mvp.png') }}" class="mvp">
                <h3 class="blaze-mvp m-0">{{$game->MVP()->player->firstname}}</h3>
            </div>
        </div>
        <div class="col-6">
            <table class="table text-white">
                <tbody>
                
                    @foreach ($game->lols as $lol)
                    {{-- {{dd($game->lols)}} --}}
                      <tr class="history-text">
                        <td>
                            @foreach ($champions['data'] as $champ)
                            @switch($champ["key"])
                                @case($lol->pivot->champion)
                                    <img src="http://ddragon.leagueoflegends.com/cdn/11.12.1/img/champion/{{ $champ['id'] }}.png"
                                        class="champ-used" alt="">
                                @break
                                @default
                            @endswitch
                        @endforeach
                        <img style="width:20px"
                            src="{{ asset('positions/Position_Diamond-' . ucfirst(strtolower($lol->pivot->position)) . '.png') }}"
                            alt="">
                            {{ $lol->pseudo }}
                        </td>
                        <td class="color-lose">
                            <i class="fas fa-bomb"></i> {{ $lol->pivot->damages }}
                        </td>
                        <td class="color-gold">
                            <i class="fas fa-coins"></i> {{ $lol->pivot->golds }}
                        </td>
                        <td>
                            <strong class="text-success">
                                {{ $lol->pivot->kills }}
                            </strong> /
                            <strong class="text-danger">
                                {{ $lol->pivot->deaths }}
                            </strong> /
                            <strong>
                                {{ $lol->pivot->assists }}
                            </strong>
                        </td>
                        <td><i class="far fa-eye"></i> {{ $lol->pivot->wardsplaced }}</td>
                        <td>{{ $lol->pivot->cs}} cs</td>
                        {{-- <td> {{ $lol->pivot->mvp}}</td> --}}
                      </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="col-4">
            
            
            <canvas id="chartDamages_{{ $game->id }}" data-id="{{ $game->id }}"></canvas>
        </div>
    </div>

    @endforeach
    </div>
    <script>
        var ctx = document.getElementById('chartSoloQ').getContext('2d');
        var ctx2 = document.getElementById('chartFlexQ').getContext('2d');
        var ctx3 = $('*[id^="chartDamages_"]');

        ctx3.each(function (key, element) {
            var id = $(element).data('id');
            // console.log(damages[key]);
            document["chartDamages_" + id] = new Chart(element, {
                type: 'bar',
                data: {
                    labels: @json($game->getDamages()[0]),
                    datasets: [{
                        label: "Dégats",
                        data: @json($game->getDamages()[1]),
                        borderColor: "orange",
                        backgroundColor : "orange"
                    }]

                },
                options: {
                    indexAxis: 'y',
                    elements: {
                        bar: {
                            borderWidth: 2,
                        }
                    },
                    // responsive: true,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: false,
                        }
                    }
                }
            });
        })


        var chartSoloQ = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! $days !!},
                datasets: [{
                    tension: 0.1,
                    label: "Prépuce Endolori",
                    data: {!! $BriceSoloQ !!},
                    borderColor: "orange",
                    backgroundColor: "orange"
                }, {
                    tension: 0.1,
                    label: "Bepo",
                    data: {!! $BepoSoloQ !!},
                    borderColor: "lightblue",
                    backgroundColor: "lightblue"
                }, {
                    tension: 0.1,
                    label: "Lbrs7",
                    data: {!! $LouisSoloQ !!},
                    borderColor: "lightgreen",
                    backgroundColor: "lightgreen"
                }, {
                    tension: 0.1,
                    label: "Azakatana",
                    data: {!! $AzaSoloQ !!},
                    borderColor: "lightpink",
                    backgroundColor: "lightpink"
                }, {
                    tension: 0.1,
                    label: "Youmel",
                    data: {!! $YoumelSoloQ !!},
                    borderColor: "lightcoral",
                    backgroundColor: "lightcoral"
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
                    backgroundColor: "orange"

                }, {
                    tension: 0.1,
                    label: "Bepo",
                    data: {!! $BepoFlexQ !!},
                    borderColor: "lightblue",
                    backgroundColor: "lightblue"


                }, {
                    tension: 0.1,
                    label: "Lbrs7",
                    data: {!! $LouisFlexQ !!},
                    borderColor: "lightgreen",
                    backgroundColor: "lightgreen"


                }, {
                    tension: 0.1,
                    label: "Azakatana",
                    data: {!! $AzaFlexQ !!},
                    borderColor: "lightpink",
                    backgroundColor: "lightpink"

                }, {
                    tension: 0.1,
                    label: "Youmel",
                    data: {!! $YoumelFlexQ !!},
                    borderColor: "lightcoral",
                    backgroundColor: "lightcoral"

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
