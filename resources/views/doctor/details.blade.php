@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('My Profile') }}
        </h2>

        @if ($errors->any())
            <div class="alert alert-danger mb-4 mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('doctor.doctor.update', $doc->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="telephone" placeholder="Telephone" aria-label="Telephone"
                    aria-describedby="basic-addon1" value="{{ old('telephone', $doc->telephone) }}">
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="performance" placeholder="Performance"
                    aria-label="Performance" aria-describedby="basic-addon1"
                    value="{{ old('performance', $doc->performance) }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{ old('description', $doc->description) }}</textarea>
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
                                {{ in_array($item->id, old('specialization', [])) ? 'checked' : '' }}
                                >
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
                            id="{{ $item->name }}" name="specialization[]"
                            {{ $doc->specializations->contains($item->id) ? 'checked' : '' }}
                            >
                        <label class="form-check-label stretched-link"
                            for="{{ $item->name }}">{{ $item->name }}</label>
                    </li>
                @endforeach
            </ul>
            @endif

            <button type="submit" class="btn btn-primary mb-3">Save</button>
        </form>
    </div>
@endsection
