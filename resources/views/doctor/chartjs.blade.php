@extends('layouts.app')

@section('content')
    <script type="text/javascript" src="{{ URL::asset('js/mychart.js') }}"></script>

    {{-- Test per grafico dei trend --}}
<div style="width: 600px; margin: auto;">
    <h2 class="text-light text-center mb-5">{{ __('Statistic charts') }}</h2>
    <canvas id="myChart"></canvas>
</div>

@endsection

