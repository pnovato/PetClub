@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Denied Payment!</h2>
    <p>Your payment was not concluded.</p>
    <a href="{{ url('/store') }}" class="btn btn-warning">Return to Store</a>
</div>
@endsection
