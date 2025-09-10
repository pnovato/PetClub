@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Make a Donation!</h2>
    <form action="{{ route('donation.process') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="amount" class="form-label">Amount (€):</label>
            <input type="number" name="amount" min="1" step="0.01" class="form-control" required>
        </div>
        <button class="btn btn-primary">Donate with Stripe</button>
    </form>
</div>
@endsection
