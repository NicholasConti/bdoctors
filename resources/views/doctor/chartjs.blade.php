<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <script type="text/javascript" src="{{ URL::asset('js/mychart.js') }}"></script>
    <title>Chart.js with Laravel 9</title>

</head>
<body>

    {{-- Test per grafico dei trend --}}

<div style="width: 600px; margin: auto;">
    <h1>SONO CHARTJS</h1>
    <canvas id="myChart"></canvas>
</div>


</body>
</html>