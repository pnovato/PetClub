@extends ('layouts.app')

@section('title', 'Pet Member')

@section('content')
<div class="pet_member_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section_title text-center">
                    <h3>Pet Member</h3>
                    <p>See our available pets. Make an Adoption.</p>
                    <p>Want to Help Us? Make a Donation.</p>
                    <a href="{{ route('donation.form') }}" class="btn btn-success mt-3">Donate</a>
                </div>
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
