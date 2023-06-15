@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('My Dashboard') }}
        </h2>
        @if ($user->doctor)
            <div class="row mb-2">
                <div class="col-12 col-lg-6">
                    <div class="profile-img d-flex align-items-center">
                        <img src="{{ asset('storage/' . $user->doctor->image) }}" alt="{{ $user->doctor->name }}">
                        <div class="ms-4">
                            <h3>{{ $user->name }} {{ $user->surname }}</h3>
                            <p>Email: {{ $user->email }} <br> Address: {{ $user->address }} <br> Telephone:
                                {{ $user->doctor->telephone }} <br> Performance: {{ $user->doctor->performance }}</p>
                        </div>
                    </div>
                    <h4 class="mt-4">Description</h4>
                    <p>{{ $user->doctor->description }}</p>
                    <h4 class="mt-4">Specializzations</h4>
                    <p>
                        <?php $tmp = ''; ?>
                        @foreach ($user->doctor->specializations as $item)
                            <?php $tmp .= $item->name . ', '; ?>
                        @endforeach
                        {{ rtrim($tmp, ', ') }}
                    </p>
                    <a href="{{ route('doctor.doctor.edit', $user->doctor->id) }}" class="btn btn-primary mb-4">Edit profile</a>
                </div>
                <div class="col-12 col-lg-6">
                    <h5>Curriculum</h5>
                    <object data="{{ asset('storage/' . $user->doctor->cv) }}" type="application/pdf" width="100%"
                        height="500px">
                    </object>
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
                        aria-label="Telephone" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="performance" placeholder="Performance"
                        aria-label="Performance" aria-describedby="basic-addon1">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="cv" class="form-label">Curriculum</label>
                    <input class="form-control" type="file" id="cv" name="cv">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Profile image</label>
                    <input class="form-control" type="file" id="image" name="image">
                </div>

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

                <button type="submit" class="btn btn-primary mb-3">Save</button>
            </form>
        @endif
    </div>
@endsection
