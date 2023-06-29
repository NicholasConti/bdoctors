@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="text-light mb-5">{{ __('Statistic charts') }}</h2>
</div>
{{-- Test per grafico dei trend --}}
<div style="width: 600px; margin: auto;">
    <canvas id="chartRM" class="bg-white"></canvas>
</div>
<div style="width: 600px; margin:auto;" class="mt-3">
    <canvas id="chartRY" class="bg-white"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">

// FUNCTION FOR STAT EACH MONTH
    function getMonthsStats(dataMonths,months){
        let arrDataMonth = [];
        for (let i = 0; i<12; i++) arrDataMonth.push(0);
        //console.log(dataMonths);
        dataMonths.forEach(element => {
            arrDataMonth[element['mese']-1]= element['count'];
        });
        //console.log(arrDataMonth);
        //dati grafico
        const data = {
            labels: months,
            datasets: [{
                label: 'Reviews',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: arrDataMonth,
            }]
        };
        //genera nuovo grafico
        const config = {
            type: 'line',
            data: data,
            options: {
            responsive: true,
            min: 0,
            ticks: {
            // forces step size to be 50 units
            stepSize: 1
        }
    }
        };
        return config;
    }
// FUNCTION FOR STAT EACH YEAR
    function getYearsStats(dataYears,years){
        let arrReviewsYear = [];
        for (let i = 0; i<years.length; i++) arrReviewsYear.push(0);
        dataYears.forEach(element => {
            years.forEach((element2,index) => {
                if(element['anno'] == element2){
                    //console.log('ciao');
                    arrReviewsYear[index]= element['count'];
                    return;
                }
            });
        });
        //console.log(arrReviewsYear);
        const dataRY = {
            labels: years,
            datasets: [{
                label: 'Years',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: arrReviewsYear,
            }]
        };
        //genera nuovo grafico
        const configRY = {
            type: 'line',
            data: dataRY,
            options: {
            responsive: true,
            min: 0,
            ticks: {
            // forces step size to be 50 units
            stepSize: 1
        }
    }
        };
        return configRY;
    }


    const labelsM = [
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
    const labelsY = [
        '2020',
        '2021',
        '2022',
        '2023'
    ];
    // STATS REVIEWS-MONTHS
    const reviewMonths = {{Js::from($reviewMese)}};
    new Chart(
        document.getElementById('chartRM'),
        getMonthsStats(reviewMonths,labelsM)
    );

    // STATS REVIEWS-YEARS
    const reviewYears = {{Js::from($reviewAnno)}};
    new Chart(
        document.getElementById('chartRY'),
        getYearsStats(reviewYears,labelsY)
    );
</script>
@endsection

