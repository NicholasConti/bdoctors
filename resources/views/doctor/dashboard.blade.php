@extends('layouts.app')

@section('content')

    <div class="background_color">
        <div class="container ">
            <h2 class="fs-4 text-secondary my-4 text-light">
                {{ __('My Dashboard') }}
            </h2>
                {{-- USER-INFO --}}
            @if ($user->doctor)
            <div class="profile-img d-flex align-items-center my-4 text-light border-bottom border-primary pb-3">
                <img src="{{ $user->doctor->image }}" alt="{{ $user->doctor->name }}">
                <div class="ms-4 mt-4">
                    <ul>
                        <h3>{{ $user->name }} {{ $user->surname }}</h3>
                        <li>Email: {{ $user->email }}</li>
                        <li>Address: {{ $user->address }}</li>
                        <li>Telephone: {{ $user->doctor->telephone }}</li>
                        <li>Performance: {{ $user->doctor->performance }}</li>
                    </ul>
                </div>
            </div>
                {{-- USER-LEFT-SIDE --}}
            <div class="d-flex">
                <div>
                    <div class="row gy-2 me-5">
                        <div class="col-12 d-flex flex-column gap-3 ms-3 mt-5">
                            <button class="btn border-0 btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                                Description
                            </button>
                            <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                                Specializations
                            </button>
                            <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                                Messages
                            </button>
                            <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                                Votes & Reviews
                            </button>
                            <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                                Sponsorships
                            </button>
                            <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                                Curriculum Vitae
                            </button>
                            <a href="{{ route('doctor.doctor.edit', $user->doctor->id) }}" class="btn btn-light">Edit profile</a>
                        </div>
                    </div>
                </div>
                {{-- USER-RIGHT-SIDE --}}
                <div class="offcanvas_box col-9 border-start border-2  border-primary" style="height: 500px;">
                    <div class="off_canvas offcanvas col-12  ms-5" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">My Curriculum Vitae</h5>
                        </div>
                        <div class="offcanvas-body">
                            <div>
                                {{-- DESCRIPTION --}}
                                <div>
                                    <p>{{ $user->doctor->description }}</p>
                                </div>
                                {{-- SPECIALIZATIONS --}}
                                <div>
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
                                {{-- MESSAGES --}}
                                <div>
                                    <ul class="list-group">
                                        @forelse ($user->doctor->messages as $key=>$item)
                                            <li class="list-group-item">{{ $key+1 }} - {{ $item->text_message }}</li>
                                        @empty
                                        <li class="list-group-item">Nessun messaggio!</li>
                                        @endforelse
                                    </ul>
                                </div>

                                {{-- VOTES --}}
                                <div>
                                    <?php $mediaVoto = 0; ?>
                                    @foreach ($user->doctor->votes as $item)
                                        <?php $mediaVoto += $item->vote; ?>
                                    @endforeach
                                    <?php if ($mediaVoto>0) $mediaVoto = $mediaVoto / count($user->doctor->votes); ?>
                                    <p class="d-inline-block">{{ $mediaVoto }}</p>
                                </div>

                                {{-- REVIEWS --}}
                                <div>
                                    <ul class="list-group">
                                        @forelse ($user->doctor->reviews as $key=>$item)
                                            <li class="list-group-item d-flex justify-content-between"><span>{{ $key+1 }} - {{ $item->text_review }}</span> <span class="badge text-bg-success text-wrap">{{ $item->name }}</span></li>
                                        @empty
                                        <li class="list-group-item">Nessuna recensione!</li>
                                        @endforelse
                                        </ul>
                                </div>

                                {{-- SPONSORSHIPS --}}
                                <div>
                                    @if (count($user->doctor->sponsorships)>0)
                                        <p class="d-inline-block">{{ $user->doctor->sponsorships[0]->name }}</p>
                                    @endif
                                </div>
                                {{-- CV --}}
                                <div>
                                    <object data="{{ asset('storage/' . $user->doctor->cv) }}" type="application/pdf" width="100%"
                                    height="500px">
                                    </object>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- / --}}
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
