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
            <p><strong>Espécie:</strong> {{ ucfirst($pet->species) }}</p>
            <p><strong>Sexo:</strong> {{ ucfirst($pet->sex) }}</p>
            <p><strong>Idade:</strong> {{ $pet->age_years }} anos</p>
            <p><strong>Porte:</strong> {{ ucfirst($pet->size) }}</p>
            <p class="mt-4">{{ $pet->description }}</p>
            @if($pet->status === 'available')
                @if(Auth::check() && (Auth::user()->is_member ?? true))
                    <a href="{{ route('pet.adopt', $pet->id) }}" class="btn btn-success mt-3">Adotar este animal</a>
                @else
                <a href="{{ route('login') }}?redirect={{ urlencode(request()->fullUrl()) }}" class="btn btn-primary mt-3">
                    Faça login para adotar
                </a>
                @endif
            @else
                <span class="badge bg-secondary mt-3">Este animal já está reservado ou adotado</span>
                @endif    
        </div>
    </div>
</div>
@endsection