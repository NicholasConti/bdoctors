@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('My Dashboard') }}
    </h2>
    <h4 class="fs-4 text-secondary my-4">
        <a href="{{ Route('admin.projects.index') }}" class="text-decoration-none">PROJECTS</a>
    </h4>
</div>
@endsection
