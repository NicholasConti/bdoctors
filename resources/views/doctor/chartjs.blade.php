@extends('layouts.app')

@section('content')

    {{-- Test per grafico dei trend --}}
<div style="width: 600px; margin: auto;">
    <h1>SONO CHARTJS</h1>
    <canvas id="myChart"></canvas>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'Dicember'
];
const reviewMonths = {{Js::from($reviewMese)}};
let arrayProva = [];
for (let i = 0; i<12; i++) arrayProva.push(0);
console.log(reviewMonths);
reviewMonths.forEach(element => {
    arrayProva[element['mese']-1]= element['count'];
});
console.log(arrayProva);
//dati grafico
const data = {
    labels: labels,
    datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: arrayProva,
    }]
};

//genera nuovo grafico
const config = {
    type: 'line',
    data: data,
    options: {}
};

new Chart(
    document.getElementById('myChart'),
    config
);
</script>
@endsection

