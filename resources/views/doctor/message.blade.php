@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4 text-light">
            {{ __('My Message') }}
        </h2>
        <div class="row gy-4">
            @forelse ($message as $key=>$item)
                <div class="col-12">
                    @if ($key % 2 == 0)
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading mb-4">Message From: {{ $item->name }} {{ $item->surname }}</h4>
                            <p>
                                {{ $item->text_message }}
                            </p>
                            <hr>
                            <p class="mb-0 d-flex justify-content-between align-items-center">
                                <span>{{ $item->email }}</span> <span>{{ $item->created_at }}</span>
                            </p>
                        </div>
                    @else
                        <div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading mb-4">Message from: {{ $item->name }} {{ $item->surname }}</h4>
                            <p>
                                {{ $item->text_message }}
                            </p>
                            <hr>
                            <p class="mb-0 d-flex justify-content-between align-items-center">
                                <span>{{ $item->email }}</span> <span>{{ $item->created_at }}</span>
                            </p>
                        </div>
                    @endif
                </div>

            @empty
                <div class="alert alert-danger" role="alert">
                    No Messages Avaibles
                </div>
            @endforelse
        </div>
    </div>
@endsection
