@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('My Profile') }}
        </h2>
        <div>
            @if ($doc->image)
                <div class="w-50 mb-2">
                    <img src="{{ asset('storage/' . $doc->image) }}" alt="{{ $doc->user->name }}" class="w-100" style="">
                </div>
            @endif
        </div>
        <h3>{{ $doc->user->name }} {{ $doc->user->surname }}</h3>
        <h3>{{ $doc->user->address }}</h3>
        <div>
            <p>{{ $doc->telephone }} - {{ $doc->performance }}</p>
            <p>{{ $doc->description }}</p>
        </div>
        <div>
            <h3>Curriculum</h3>
            @if ($doc->cv)
                <div class="w-50 mb-2">
                    <object data="{{ asset('storage/' . $doc->cv) }}"
                        type="application/pdf" width="100%" height="500px">
                        <p>Unable to display PDF file. <a
                                href="{{ asset('storage/' . $doc->cv) }}">Download</a>
                            instead.</p>
                    </object>
                </div>
            @endif
        </div>
    </div>
@endsection
