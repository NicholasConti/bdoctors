@extends('layouts.app')

@section('content')


    <div class="background_color">
        <div class="container">
            <h2 class="fs-4 text-secondary text-center my-4 text-light">
                {{ __('My Dashboard') }}
            </h2>
            {{-- USER-INFO --}}
            @if ($user->doctor)
                <div class="profile-img d-flex align-items-center my-4 text-light border-bottom border-primary pb-3">
                    <div class="pt-4 pe-3">
                        <img src="{{ $user->doctor->image }}" alt="{{ $user->doctor->name }}">
                    </div>

                    <div class="pe-5 me-5 mt-4 pt-2 d-flex flex-column gap-1">
                        <div class="d-flex">
                            <h3>Dr. {{ $user->name }} {{ $user->surname }}</h3>
                            @if ($isSponsor)
                                <span class="badge text-bg-success ms-2 mt-2"
                                    style="height: 20px;">{{ $isSponsor->name }}</span>
                            @endif
                        </div>

                        <ul class="d-flex flex-column gap-2">
                            <li><i class="fa-solid fa-envelope me-2"></i> {{ $user->email }}</li>
                            <li><i class="fa-solid fa-location-dot me-2"></i> {{ $user->address }}</li>
                            <li><i class="fa-solid fa-phone-flip me-2"></i> {{ $user->doctor->telephone }}</li>
                            <li><i class="fa-solid fa-briefcase-medical me-2"></i> {{ $user->doctor->performance }}</li>
                        </ul>
                    </div>
                </div>
                {{-- USER-LEFT-SIDE --}}
                <div class="d-flex flex-column ">
                    <div
                        class="d-flex gap-2 mb-5 d-none d-md-block col-md-12 container-sm text-center border-bottom border-primary pb-3">
                        <button class="btn btn_color m-1" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasMessages" aria-controls="offcanvasScrolling">
                            <span><i class="fa-solid fa-message pe-2"></i>Messages</span>
                        </button>
                        <button class="btn btn_color m-1" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasVotes" aria-controls="offcanvasScrolling">
                            <span><i class="fa-solid fa-star-half-stroke pe-2"></i>Votes & Reviews</span>
                        </button>
                        <button class="btn btn_color m-1" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasSponsorship" aria-controls="offcanvasScrolling">
                            <span><i class="fa-solid fa-arrow-up-right-dots pe-2"></i>Sponsorships</span>
                        </button>
                        <button class="btn btn_color m-1" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasCV" aria-controls="offcanvasScrolling">
                            <span><i class="fa-solid fa-file-pdf pe-2"></i>Curriculum Vitae</span>
                        </button>
                        <a href="{{ route('doctor.doctor.edit', $user->doctor->id) }}" class="btn btn_color"><i
                                class="fa-solid fa-user-pen pe-2"></i>Edit Profile</a>
                    </div>
                    {{-- USER-ICONS-@MOBILE --}}
                    <div
                        class="user_icon d-flex justify-content-center text-center gap-2 d-sm-block d-md-none border-bottom border-primary pb-3">
                        <button title="Messages" class="btn btn_color" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasMessages" aria-controls="offcanvasScrolling"><span><i
                                    class="fa-solid fa-message"></i></span></button>
                        <button title="Reviews" class="btn btn_color" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasVotes" aria-controls="offcanvasScrolling"><span><i
                                    class="fa-solid fa-star-half-stroke"></i></span></button>
                        <button title="Sponsorships" class="btn btn_color" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasSponsorship" aria-controls="offcanvasScrolling"><span><i
                                    class="fa-solid fa-arrow-up-right-dots"></i></span></button>
                        <button title="CV" class="btn btn_color" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasCV" aria-controls="offcanvasScrolling"><span><i
                                    class="fa-solid fa-file-pdf"></i></span></button>
                        <a title="Edit Profile" href="{{ route('doctor.doctor.edit', $user->doctor->id) }}"
                            class="btn btn_color"><i class="fa-solid fa-user-pen"></i></a>
                    </div>
                    {{-- / --}}
                    {{-- USER-RIGHT-SIDE --}}
                    <div class="offcanvas_box col-12">

                        {{-- Offcanvas_Messages --}}
                        <div class="off_canvas offcanvas col-12 rounded" tabindex="-1" data-bs-scroll="true"
                            data-bs-backdrop="false" id="offcanvasMessages" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header d-flex justify-content-center">
                                <h3 class="offcanvas-title" id="offcanvasScrollingLabel">Messages received</h3>
                            </div>
                            <div class="offcanvas-body">
                                {{-- MESSAGES --}}
                                <div>
                                    @forelse ($user->doctor->messages as $key=>$item)
                                        <div class="bg_color_light  m-2 py-2">
                                            <div class="m-1">
                                                <div class="badge text-bg-success text-wrap m-1">
                                                    <h5 class="text-light pt-2">Message from: {{ $item->email }}</h5>
                                                </div>
                                                <div class="px-1 py-1">
                                                    <h6>{{ $item->name }}</h6>
                                                    <h6>{{ $key + 1 }} - {{ $item->text_message }}</h6>
                                                </div>

                                            </div>
                                            <div class="actions text-center py-2">
                                                <a class="fw-bold bg-info text-light px-3 py-1 rounded me-2" href="#">Reply</a>
                                                <a class="fw-bold bg-danger text-light px-3 py-1 rounded" href="#">Delete</a>
                                            </div>
                                        </div>
                                    @empty
                                        <span class="list-group-item">No messages yet!</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        {{-- /Offcanvas_Messages --}}

                        {{-- Offcanvas_Votes&reviews --}}
                        <div class="off_canvas offcanvas col-12 rounded" tabindex="-1" data-bs-scroll="true"
                            data-bs-backdrop="false" id="offcanvasVotes" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header d-flex justify-content-center">
                                <h3 class="offcanvas-title" id="offcanvasScrollingLabel">Your Votes and Reviews</h3>
                            </div>
                            <div class="offcanvas-body">
                                {{-- VOTES --}}
                                <div>
                                    <?php $mediaVoto = 0; ?>
                                    @foreach ($user->doctor->votes as $item)
                                        <?php $mediaVoto += $item->vote; ?>
                                    @endforeach
                                    <?php if ($mediaVoto > 0) {
                                        $mediaVoto = $mediaVoto / count($user->doctor->votes);
                                    } ?>
                                    <div class="d-inline-block">
                                        <h5>Avg doctor vote: {{ $mediaVoto }}</h5>
                                    </div>
                                </div>
                                {{-- REVIEWS --}}

                                <div class="m-2 py-1">
                                    @forelse ($user->doctor->reviews as $key=>$item)
                                        <div class="py-2 m-2 bg_color_light">
                                            <div class="badge text-bg-success text-wrap m-1">
                                                <h5 class="text-light pt-2">From: {{ $item->name }}</h5>
                                            </div>
                                            <div class="py-2 m-1">
                                                <h6>{{ $key + 1 }} - {{ $item->text_review }}</h6>
                                            </div>
                                            <div class="actions text-center">
                                                <a class="fw-bold bg-info text-light rounded px-3 py-1 me-2" href="#">Reply</a>
                                                <a class="fw-bold bg-danger text-light rounded px-3 py-1" href="#">Delete</a>
                                            </div>
                                        </div>
                                    @empty
                                        <li class="list-group-item">Nessuna recensione!</li>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{-- Offcanvas_Votes&reviews --}}
                        {{-- Offcanvas_Sponsorship --}}

                        <div class="off_canvas offcanvas col-12 rounded" tabindex="-1" data-bs-scroll="true"
                            data-bs-backdrop="false" id="offcanvasSponsorship" aria-labelledby="offcanvasScrollingLabel">
                            <div class="d-flex justify-content-center m-3">
                                @if (!$isSponsor)
                                    <h3 class="offcanvas-title" id="offcanvasScrollingLabel">Seleziona il tuo pacchetto</h3>
                                @endif
                            </div>
                            <div class="offcanvas-body">
                                <div class="offcanvas-body">
                                    {{-- SPONSORSHIPS --}}

                                    @if ($isSponsor)
                                        <div class="container-fluid text-center">
                                            <h4>Hai già una sponsorship attiva!</h4>
                                        </div>
                                    @else
                                        <form id="package-form">

                                            <div class="container-fluid">
                                                <div class="row d-flex justify-content-center">
                                                    @foreach ($sponsor as $sponsorship)
                                                        <div class="plan d-flex">
                                                            <div class="inner">
                                                                <span class="pricing">
                                                                    <span>
                                                                        ${{ $sponsorship->price }}
                                                                    </span>
                                                                </span>
                                                                <p class="title"><input type="radio" name="package"
                                                                        value=" {{ $sponsorship->id }}">
                                                                    {{ $sponsorship->name }}</p>
                                                                <p class="info">This plan is for those who have a team
                                                                    already and running a large business.</p>
                                                                <ul class="features">
                                                                    <li>
                                                                        <span class="icon">
                                                                            <svg height="24" width="24"
                                                                                viewBox="0 0 24 24"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M0 0h24v24H0z" fill="none">
                                                                                </path>
                                                                                <path fill="currentColor"
                                                                                    d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z">
                                                                                </path>
                                                                            </svg>
                                                                        </span>
                                                                        <span
                                                                            class="color_sponsor_text">Duration<strong>{{ $sponsorship->duration }}hrs</strong></span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="icon">
                                                                            <svg height="24" width="24"
                                                                                viewBox="0 0 24 24"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M0 0h24v24H0z" fill="none">
                                                                                </path>
                                                                                <path fill="currentColor"
                                                                                    d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z">
                                                                                </path>
                                                                            </svg>
                                                                        </span>
                                                                        <span class="color_sponsor_text">Price
                                                                            <strong>${{ $sponsorship->price }}</strong></span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="d-flex justify-content-center mt-5">
                                                    <input class="btn_color" type="submit" value="Procedi al pagamento">
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- Offcanvas_Sponsorship --}}

                        {{-- Offcanvas_CV --}}
                        <div class="off_canvas offcanvas col-12 rounded" tabindex="-1" data-bs-scroll="true"
                            data-bs-backdrop="false" id="offcanvasCV" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">CV</h5>
                            </div>
                            <div class="offcanvas-body">
                                {{-- CV --}}
                                <div class="d-flex justify-content-center">
                                    <object data="{{ $user->doctor->cv }}" type="application/pdf" width="60%"
                                        height="800px"></object>
                                </div>
                            </div>
                        </div>
                        {{-- Offcanvas_CV --}}

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
                        <!-- profile cv preview -->
                        <div class="preview pt-2">
                            <object id="file-cv-preview" type="application/pdf" width="20%"
                                class="border border-0 rounded"></object>
                        </div>
                        <!-- /profile cv preview -->
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile image</label>
                        <input class="form-control" type="file" id="image" name="image">
                        <!-- profile image preview -->
                        <div class="preview pt-2">
                            <img id="file-image-preview" width="20%" class="rounded">
                        </div>
                        <!-- /profile image preview -->
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
