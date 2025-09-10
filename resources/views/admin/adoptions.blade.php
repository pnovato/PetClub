@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <h2 class="mb-4">History of Approved Adoptions</h2>

    @if($pets->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Animal</th>
                    <th>Species</th>
                    <th>Adopter</th>
                    <th>Date of Adoption</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pets as $pet)
                    <tr>
                        <td>{{ $pet->name }}</td>
                        <td>{{ $pet->species }}</td>
                        <td>{{ $pet->adopter->name ?? 'N/A' }}</td>
                        <td>{{ $pet->adopted_at ? $pet->adopted_at->format('d/m/Y H:i') : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No approved adoptions found.</p>
    @endif
</div>
@endsection
