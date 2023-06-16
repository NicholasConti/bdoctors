@extends('layouts.app')

@section('content')

    <div class="background_color">
        <div class="container ">
            <h2 class="fs-4 text-secondary my-4">
                {{ __('My Dashboard') }}
            </h2>
                {{-- USER-INFO --}}
            @if ($user->doctor)
            <div class="profile-img d-flex align-items-center my-4">
                <img src="{{ $user->doctor->image }}" alt="{{ $user->doctor->name }}">
                <div class="ms-4">
                    <h3>{{ $user->name }} {{ $user->surname }}</h3>
                    <p>Email: {{ $user->email }} <br> Address: {{ $user->address }} <br> Telephone:
                        {{ $user->doctor->telephone }} <br> Performance: {{ $user->doctor->performance }}
                    </p>
                </div>
            </div><hr>
                {{-- USER-LEFT-SIDE --}}
            <div class="d-flex">
                <div>
                    <div class="row gy-2 border-end me-5">
                        <div class="col-12">
                            <h4 class=" btn btn-primary mt-4">Description</h4>
                            <p>{{ $user->doctor->description }}</p>
                            <h4 class=" btn btn-primary">Specializations</h4>
                            <?php $tmp = ''; ?>
                            <p>
                                @forelse ($user->doctor->specializations as $item)
                                    <?php $tmp .= $item->name . ', '; ?>
                                @empty
                                    <?php $tmp = 'Nessuna specializzazione, '; ?>
                                @endforelse
                                {{ rtrim($tmp, ', ') }}
                            </p>
                            <a href="{{ route('doctor.doctor.edit', $user->doctor->id) }}" class="btn btn-primary">Edit profile</a>
                        </div>

                        <div class="col-12">
                            <h4 class="btn btn-primary d-inline-block">Media Voti ricevuti:</h4>
                            <?php $mediaVoto = 0; ?>
                            @foreach ($user->doctor->votes as $item)
                                <?php $mediaVoto += $item->vote; ?>
                            @endforeach
                            <?php if ($mediaVoto>0) $mediaVoto = $mediaVoto / count($user->doctor->votes); ?>
                            <p class="d-inline-block">{{ $mediaVoto }}</p>
                            <div>
                                <h4 class="btn btn-primary d-inline-block">Sponsors:</h4>
                                @if (count($user->doctor->sponsorships)>0)
                                    <p class="d-inline-block">{{ $user->doctor->sponsorships[0]->name }}</p>
                                @endif
                            </div>
                            <h4 class="btn btn-primary">Description</h4>
                            <p>{{ $user->doctor->description }}</p>
                            <h4 class="btn btn-primary">Specializations</h4>
                            <?php $tmp = ''; ?>
                            <p>
                                @forelse ($user->doctor->specializations as $item)
                                    <?php $tmp .= $item->name . ', '; ?>
                                @empty
                                    <?php $tmp = 'Nessuna specializzazione, '; ?>
                                @endforelse
                                {{ rtrim($tmp, ', ') }}
                            </p>
                        </div>
                    </div>
                </div>
                {{-- USER-RIGHT-SIDE --}}
                <div class="col-9">
                    <object data="{{ asset('storage/' . $user->doctor->cv) }}" type="application/pdf" width="100%"
                        height="500px">
                    </object>
                </div>
                {{-- / --}}
            </div>

            <div class="row mt-5">
                <div class="col-6">
                    <div class="card">
                        <h5 class="card-header">Messaggi Ricevuti</h5>
                        <div class="card-body">
                            <ul class="list-group">
                                @forelse ($user->doctor->messages as $key=>$item)
                                    <li class="list-group-item">{{ $key+1 }} - {{ $item->text_message }}</li>
                                @empty
                                <li class="list-group-item">Nessun messaggio!</li>
                                @endforelse

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <h5 class="card-header">Recensioni Ricevute</h5>
                        <div class="card-body">
                            <ul class="list-group">
                                @forelse ($user->doctor->reviews as $key=>$item)
                                    <li class="list-group-item d-flex justify-content-between"><span>{{ $key+1 }} - {{ $item->text_review }}</span> <span class="badge text-bg-success text-wrap">{{ $item->name }}</span></li>
                                @empty
                                <li class="list-group-item">Nessuna recensione!</li>
                                @endforelse

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @else
                @if ($errors->any())
                    <div class="alert alert-danger mb-4 mt-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('doctor.doctor.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="telephone" placeholder="Telephone"
                            aria-label="Telephone" aria-describedby="basic-addon1" value="{{ old('telephone') }}">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="performance" placeholder="Performance"
                            aria-label="Performance" aria-describedby="basic-addon1" value="{{ old('performance') }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="cv" class="form-label">Curriculum</label>
                        <input class="form-control" type="file" id="cv" name="cv">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile image</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>

                    @if ($errors->any())
                        <ul class="list-group mb-3">
                            @foreach ($spec as $item)
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="{{ $item->id }}"
                                        id="{{ $item->name }}" name="specialization[]"
                                        {{ in_array($item->id, old('specialization', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label stretched-link"
                                        for="{{ $item->name }}">{{ $item->name }}</label>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <ul class="list-group mb-3">
                            @foreach ($spec as $item)
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="{{ $item->id }}"
                                        id="{{ $item->name }}" name="specialization[]">
                                    <label class="form-check-label stretched-link"
                                        for="{{ $item->name }}">{{ $item->name }}</label>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <button type="submit" class="btn btn-primary mb-3">Save</button>
                </form>
            @endif
        </div>
    </div>

@endsection
