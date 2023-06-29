@extends('layouts.app')

@section('content')
    <script type="text/javascript" src="{{ URL::asset('js/mychart.js') }}"></script>

    {{-- Test per grafico dei trend --}}
<div style="width: 600px; margin: auto;">
    <h1>SONO CHARTJS</h1>
    <canvas id="myChart"></canvas>
</div>

@endsection

