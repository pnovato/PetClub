@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Successful Payment!</h2>
    <p>Thank you for your acquisition.</p>
    <a href="{{ url('/store') }}" class="btn btn-success">Return to Store</a>
</div>
@endsection
