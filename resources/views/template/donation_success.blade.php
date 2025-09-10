@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thank you for your Donation!</h2>
    <p>Your Contribution Helps us Care More Animals!</p>
    <a href="{{ route('donation.form') }}" class="btn btn-outline-primary">Make a New Donation</a>
</div>
@endsection
