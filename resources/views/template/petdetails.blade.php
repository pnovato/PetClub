@extends('layouts.app')

@section('title', 'Pet Details')

@section('content')
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6 text-center">
            @php
                $image = $pet->image && file_exists(public_path('img/pets/' . $pet->image))
                        ? $pet->image
                        : 'placeholder.jpg';
            @endphp
            <img src="{{ asset('img/pets/' . $image) }}" class="img-fluid rounded" alt="{{ $pet->name }}">
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">{{ $pet->name }}</h2>
            <p><strong>Species:</strong> {{ ucfirst($pet->species) }}</p>
            <p><strong>Sex:</strong> {{ ucfirst($pet->sex) }}</p>
            <p><strong>Age:</strong> {{ $pet->age_years }} anos</p>
            <p><strong>Size:</strong> {{ ucfirst($pet->size) }}</p>
            <p class="mt-4">{{ $pet->description }}</p>
            @if($pet->status === 'available')
                @if(Auth::check() && (Auth::user()->is_member ?? true))
                    <a href="{{ route('pet.adopt', $pet->id) }}" class="btn btn-success mt-3">Adopt</a>
                @else
                <a href="{{ route('login') }}?redirect={{ urlencode(request()->fullUrl()) }}" class="btn btn-primary mt-3">
                    Log in to Adopt
                </a>
                @endif
            @else
                <span class="badge bg-secondary mt-3">You have reserved this pet! Wait for our contact.</span>
                @endif    
        </div>
    </div>
</div>
@endsection