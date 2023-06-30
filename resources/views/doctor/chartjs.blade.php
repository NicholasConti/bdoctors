@extends('layouts.app')

@section('content')

<div class="container ">
    <h2 class="text-light text-center mb-3">{{ __('Statistic charts') }}</h2>
</div>    
<div class="container">
    <h3 class="text-light text-center mb-5">{{ __('Statistic charts') }}</h3>
</div>
{{-- Test per grafico dei trend --}}


    <div
            class="d-flex gap-2 mb-5 d-none d-md-block col-md-12 container-sm text-center border-bottom border-primary pb-3">
        <button class="btn btn_color m-1" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasMessages" aria-controls="offcanvasScrolling">
        <span><i class="fa-solid fa-message pe-2"></i>Messages</span>
        </button>
        <button class="btn btn_color m-1" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasVotes" aria-controls="offcanvasScrolling">
        <span><i class="fa-solid fa-star-half-stroke pe-2"></i>Votes</span>
        </button>
        <button class="btn btn_color m-1" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasReviews" aria-controls="offcanvasScrolling">
        <span><i class="fa-solid fa-star-half-stroke pe-2"></i>Reviews</span>
        </button>
    </div>

    <div class="offcanvas_box container mb-4">

        {{-- Messages --}}
        <div class="off_canvas offcanvas col-12 rounded show" tabindex="-1" data-bs-scroll="true"
            data-bs-backdrop="false" id="offcanvasMessages" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header d-flex justify-content-center h-25">
                <h3 class="offcanvas-title" id="offcanvasScrollingLabel">Messages</h3>
            </div>
            <div class="offcanvas-body d-flex  align-items-center h-75">
                <div style="width: 450px; margin:auto;" class="mt-3">
                    <h5 class="text-center">per month</h5>
                    <canvas id="chartMM" class="bg-white"></canvas>
                </div>
                
                <div style="width: 450px; margin:auto;" class="mt-3">
                    <h5 class="text-center">per year</h5>
                    <canvas id="chartMY" class="bg-white"></canvas>
                </div>
            </div>
        </div>

        {{-- Votes --}}
        <div class="off_canvas offcanvas col-12 rounded" tabindex="-1" data-bs-scroll="true"
            data-bs-backdrop="false" id="offcanvasVotes" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header d-flex justify-content-center h-25">
                <h3 class="offcanvas-title" id="offcanvasScrollingLabel">Votes</h3>
            </div>
            <div class="offcanvas-body d-flex  align-items-center h-75">
                <div style="width: 450px; margin:auto;" class="mt-3">
                    <h5 class="text-center">per month</h5>
                    <canvas id="chartVM" class="bg-white"></canvas>
                </div>
                <div style="width: 450px; margin:auto;" class="mt-3">
                    <h5 class="text-center">per year</h5>
                    <canvas id="chartVY" class="bg-white"></canvas>
                </div>
            </div>
        </div>

        {{-- Reviews --}}
        <div class="off_canvas offcanvas col-12 rounded" tabindex="-1" data-bs-scroll="true"
            data-bs-backdrop="false" id="offcanvasReviews" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header d-flex justify-content-center h-25">
                <h3 class="offcanvas-title" id="offcanvasScrollingLabel">Reviews</h3>
            </div>
            <div class="offcanvas-body d-flex align-items-center h-75">
                <div style="width: 450px; margin: auto;" class="mt-3">
                    <h5 class="text-center">per month</h5>
                    <canvas id="chartRM" class="bg-white"></canvas>
                </div>
                <div style="width: 450px; margin:auto;" class="mt-3">
                    <h5 class="text-center">per year</h5>
                    <canvas id="chartRY" class="bg-white"></canvas>
                </div>
            </div>
        </div>

    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">

// FUNCTION FOR STAT EACH MONTH
    function getMonthsStats(dataMonths,months, typegraph='line'){
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
                label: 'Data',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: arrDataMonth,
            }]
        };
        //genera nuovo grafico
        const config = {
            type: typegraph,
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
    function getYearsStats(dataYears,years,typegraph='line'){
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
                label: 'Data',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: arrReviewsYear,
            }]
        };
        //genera nuovo grafico
        const configRY = {
            type: typegraph,
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

    // STATS MESSAGES-MONTHS
    const messageMonths = {{Js::from($messageMese)}};
    new Chart(
        document.getElementById('chartMM'),
        getMonthsStats(messageMonths,labelsM)
    );

    // STATS MESSAGE-YEARS
    const messageYears = {{Js::from($messageAnno)}};
    new Chart(
        document.getElementById('chartMY'),
        getYearsStats(messageYears,labelsY)
    );

    // STATS VOTES-MONTHS
    const votesMonths = {{Js::from($votiMese)}};
    new Chart(
        document.getElementById('chartVM'),
        getMonthsStats(votesMonths,labelsM,'bar')
    );

    // STATS VOTES-YEARS
    const votesYears = {{Js::from($votiAnno)}};
    new Chart(
        document.getElementById('chartVY'),
        getYearsStats(votesYears,labelsY,'bar')
    );
</script>
@endsection

