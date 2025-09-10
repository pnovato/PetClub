@extends ('layouts.app')

@section('title', 'Pet Member')

@section('content')
<div class="pet_member_area">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-md-6 text-md-start text-center">
                <h3 class="mb-2">Pet Member</h3>
                <p class="mb-1">See our available pets. Make an Adoption.</p>
            </div>
            <div class="col-md-6 text-md-end text-center">
                <h3 class="mb-2">Want to Help Us? Make a Donation.</h3>
                <a href="{{ route('donation.form') }}" class="btn btn-success">Donate</a>
            </div>
        </div>
        <br>
            @if(isset($pets) && $pets->count())
                <div class="row">
                    @foreach($pets as $pet)
                        <div class="col-lg-4 col-md-6">
                            <div class="single_pet_member">
                                <div class="pet_thumb">
                                    @php
                                        $image = $pet->image && file_exists(public_path('img/pets/'.$pet->image)) ? $pet->image : 'placeholder.jpg';
                                    @endphp
                                    <img src="{{ asset('img/pets/'.$image) }}" alt="{{ $pet->name }}">
                                </div>
                            <div class="pet_info">
                                <h4>{{ $pet->name }}</h4>
                                <p>{{ $pet->description }}</p>
                                <a href="{{ route('pet.details', $pet->id) }}" class="boxed-btn3">Details</a>
                                @if(Auth::check() && (Auth::user()->is_member ?? true))
                                    <a href="{{ route('pet.adopt', $pet->id) }}" class="boxed-btn4">Adopt</a>
                                @else
                                    <a href="{{ route('login') }}?redirect={{ urlencode(request()->fullUrl()) }}" class="boxed-btn4">Login to Adopt</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p>No pet available.</p>
            @endif
    </div>
</div>
@endsection
