@extends('layouts.app')

@section('content')

<div class="container bg-light p-3">
        <canvas id="myChart"></canvas>
</div>
<script>
var ctx = document.getElementById('myChart');
const annotation1 = {
    type: 'box',
  backgroundColor: 'rgba(0,150,0,0.02)',
  borderColor: 'rgba(0,150,0,0.2)',
  yMin: 1000,
  yMax: 2000
};
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! $days !!},
        datasets: [{
                 tension: 0.1,
                 label: "Prépuce Endolori SoloQ",
                data: {!!$BriceSoloQ!!},
                backgroundColor: "pink",
                borderColor: "pink", 
            }, {
                 tension: 0.1,
                 label: "Prépuce Endolori FlexQ",
                data: {!!$BriceFlexQ!!},
                backgroundColor: "teal",
                borderColor: "teal", 
            }, {
                 tension: 0.1,
                 label: "Bepo SoloQ",
                data: {!!$BepoSoloQ!!},
                backgroundColor: "pink",
                borderColor: "pink", 
            }, {
                 tension: 0.1,
                 label: "Bepo FlexQ",
                data: {!!$BepoFlexQ!!},
                backgroundColor: "teal",
                borderColor: "teal", 
            }, {
                 tension: 0.1,
                 label: "Lbrs7 SoloQ",
                data: {!!$LouisSoloQ!!},
                backgroundColor: "pink",
                borderColor: "pink", 
            }, {
                 tension: 0.1,
                 label: "Lbrs7 FlexQ",
                data: {!!$LouisFlexQ!!},
                backgroundColor: "teal",
                borderColor: "teal", 
            }, {
                 tension: 0.1,
                 label: "Azakatana SoloQ",
                data: {!!$AzaSoloQ!!},
                backgroundColor: "pink",
                borderColor: "pink", 
            }, {
                 tension: 0.1,
                 label: "Azakatana FlexQ",
                data: {!!$AzaFlexQ!!},
                backgroundColor: "teal",
                borderColor: "teal", 
            }, {
                 tension: 0.1,
                 label: "Youmel SoloQ",
                data: {!!$YoumelSoloQ!!},
                backgroundColor: "pink",
                borderColor: "pink", 
            }, {
                 tension: 0.1,
                 label: "Youmel FlexQ",
                data: {!!$YoumelFlexQ!!},
                backgroundColor: "teal",
                borderColor: "teal", 
            }]
           
    },
    options: {
        scales: {
            y: {
                beginAtZero: false
            }
        }
    }
});


Chart.register(annotationPlugin);

</script>
@endsection
