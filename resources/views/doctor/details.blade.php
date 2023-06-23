@extends('layouts.app')

@section('content')

    <div class="background_color">
        
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
                    <input minlength="2" maxlength="30" type="text" class="form-control" name="telephone" placeholder="Telephone" aria-label="Telephone"
                        aria-describedby="basic-addon1" value="{{ old('telephone', $doc->telephone) }}">
                </div>
                <div class="input-group mb-3">
                    <input maxlength="250" type="text" class="form-control" name="performance" placeholder="Performance"
                        aria-label="Performance" aria-describedby="basic-addon1"
                        value="{{ old('performance', $doc->performance) }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3" name="description">{{ old('description', $doc->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="cv" class="form-label">Curriculum</label>
                    @if ($doc->cv)
                    <span class="badge rounded-pill text-bg-info ms-2">File already updated</span>
                    @endif
                    <input class="form-control" type="file" id="cv" name="cv">
                     <!-- profile cv preview -->
                     <div class="preview pt-2">
                        @if ($doc->cv)
                        <a href="{{$doc->cv}}" target="_blank" class="badge rounded-pill text-bg-warning">Click to see</a>
                            
                        @endif
                        {{-- <object data="{{ $doc->cv }}" type="application/pdf" width="20%" class="border border-dark rounded"></object> --}}
                    </div>
                    <!-- /profile cv preview -->
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Profile image</label>
                    <input class="form-control" type="file" id="image" name="image">
                    <!-- profile image preview -->
                    <div class="preview pt-2">
                        <img id="file-image-preview" class="border border-dark rounded" width="20%" @if($doc->image) src="{{ $doc->image }}"  alt="{{ $doc->name }}" @endif>
                    </div>
                    <!-- /profile image preview -->
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
    </div>
    
@endsection
