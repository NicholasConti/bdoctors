@extends('layouts.app')

@section('content')


    <div class="background_color">
        <div class="container">
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
            <div class="d-flex flex-column">
                <div class="d-flex gap-2 mb-5 d-none d-md-block col-md-12 container-sm text-center border-bottom border-primary pb-3">
                    <button class="btn border-0 btn_color btn-light m-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDescription" aria-controls="offcanvasScrolling">
                        Description
                    </button>
                    <button class="btn btn_color btn-light m-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSpecializations" aria-controls="offcanvasScrolling">
                        Specializations
                    </button>
                    <button class="btn btn_color btn-light m-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMessages" aria-controls="offcanvasScrolling">
                        Messages
                    </button>
                    <button class="btn btn-light m-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasVotes&reviews" aria-controls="offcanvasScrolling">
                        Votes & Reviews
                    </button>
                    <button class="btn btn_color btn-light m-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSponsorship" aria-controls="offcanvasScrolling">
                        Sponsorships
                    </button>
                    <button class="btn btn_color btn-light m-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCV" aria-controls="offcanvasScrolling">
                        Curriculum Vitae
                    </button>
                    <button class="btn btn-light m-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTrend" aria-controls="offcanvasScrolling">
                        Trend
                    </button>
                    <a href="{{ route('doctor.doctor.edit', $user->doctor->id) }}" class="btn btn-light">Edit Profile</a>
                </div>
                {{-- USER-ICONS-@MOBILE --}}
                <div class="user_icon d-flex gap-2 d-sm-block d-md-none mb-5 text-center border-bottom border-primary pb-3">
                    <button title="Description" class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDescription" aria-controls="offcanvasScrolling"><span class="text-primary"><i class="fa-solid fa-info"></i></span></button>
                    <button title="Specializations" class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSpecializations" aria-controls="offcanvasScrolling"><span class="text-primary"><i class="fa-sharp fa-solid fa-suitcase-medical"></i></span></button>
                    <button title="Messages" class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMessages" aria-controls="offcanvasScrolling"><span class="text-primary"><i class="fa-solid fa-message"></i></span></button>
                    <button title="Reviews" class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasVotes&reviews" aria-controls="offcanvasScrolling"><span class="text-primary"><i class="fa-solid fa-star-half-stroke"></i></span></button>
                    <button title="Sponsorships" class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSponsorship" aria-controls="offcanvasScrolling"><span class="text-primary"><i class="fa-solid fa-arrow-up-right-dots"></i></span></button>
                    <button title="CV" class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCV" aria-controls="offcanvasScrolling"><span class="text-primary"><i class="fa-solid fa-file-pdf"></i></span></button>
                    <button title="Trend" class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTrend" aria-controls="offcanvasScrolling"><span class="text-primary"><i class="fa-solid fa-chart-column"></i></span></button>
                    <a title="Edit Profile" href="{{ route('doctor.doctor.edit', $user->doctor->id) }}" class="btn btn-light text-primary"><i class="fa-solid fa-user-pen"></i></a>
                </div>
                {{-- / --}}
                {{-- USER-RIGHT-SIDE --}}
                <div class="offcanvas_box col-12">
                    {{-- Offcanvas_Description --}}
                    <div class="off_canvas offcanvas rounded" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvasDescription" aria-labelledby="offcanvasScrollingLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Description</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>

                        </div>
                        <div class="offcanvas-body">
                            <div>
                                {{-- DESCRIPTION --}}
                                <div>
                                    <p>{{ $user->doctor->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Offcanvas_Description --}}

                    {{-- Offcanvas_Specializations --}}
                    <div class="off_canvas offcanvas col-12 ms-5 rounded" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvasSpecializations" aria-labelledby="offcanvasScrollingLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Your Specializations</h5>
                        </div>
                        <div class="offcanvas-body">
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
                        </div>
                    </div>
                    {{-- Offcanvas_Specializations --}}

                    {{-- Offcanvas_Messages --}}
                    <div class="off_canvas offcanvas col-12 ms-5 rounded" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvasMessages" aria-labelledby="offcanvasScrollingLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Messages received</h5>
                        </div>
                        <div class="offcanvas-body">
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
                        </div>
                    </div>
                    {{-- Offcanvas_Messages --}}

                    {{-- Offcanvas_Votes&reviews --}}
                    <div class="off_canvas offcanvas col-12 ms-5 rounded" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvasVotes&reviews" aria-labelledby="offcanvasScrollingLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Your Votes and Reviews</h5>
                        </div>
                        <div class="offcanvas-body">
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
                        </div>
                    </div>
                    {{-- Offcanvas_Votes&reviews --}}

                    {{-- Offcanvas_Sponsorship --}}
                    <div class="off_canvas offcanvas col-12 ms-5 rounded" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvasSponsorship" aria-labelledby="offcanvasScrollingLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Seleziona il tuo pacchetto</h5>
                        </div>
                        <div class="offcanvas-body">
                                {{-- SPONSORSHIPS --}}
                            <form id="package-form" >
                                @foreach ($sponsor as $sponsorship)
                                <input type="radio" name="package" value="{{$sponsorship->id}}">{{ $sponsorship->name }}<br>
                                @endforeach
                                <input type="submit" value="Procedi al pagamento">
                            </form>
                        </div>
                    </div>
                    {{-- Offcanvas_Sponsorship --}}

                    {{-- Offcanvas_CV --}}
                    <div class="off_canvas offcanvas col-12 rounded" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvasCV" aria-labelledby="offcanvasScrollingLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">CV</h5>
                        </div>
                        <div class="offcanvas-body">
                                {{-- CV --}}
                            <div>
                                <object data="{{ $user->doctor->cv }}" type="application/pdf" width="100%" height="500px"></object>
                            </div>
                        </div>
                    </div>
                    {{-- Offcanvas_CV --}}
                    <div class="off_canvas offcanvas rounded" tabindex="-1" data-bs-scroll="true" data-bs-backdrop="false" id="offcanvasTrend" aria-labelledby="offcanvasScrollingLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Trand</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            GRAFICO
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