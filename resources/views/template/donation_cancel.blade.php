@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Canceled Donation</h2>
    <p>You can try again anytime. Thank you for your interest!</p>
    <a href="{{ route('donation.form') }}" class="btn btn-outline-secondary">Back</a>
</div>
@endsection
