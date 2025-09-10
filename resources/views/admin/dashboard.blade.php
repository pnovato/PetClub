@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Peding Adoption Requests</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($pets->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Animal</th>
                        <th>Species</th>
                        <th>Adopter</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pets as $pet)
                        <tr>
                            <td>{{ $pet->name }}</td>
                            <td>{{ ucfirst($pet->species) }}</td>
                            <td>{{ $pet->adopter->name ?? '—' }}</td>
                            <td>{{ ucfirst($pet->status) }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.pets.approve', $pet->id) }}" style="display:inline;">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('admin.pets.reject', $pet->id) }}" style="display:inline;">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No peding request of adoption.</p>
        @endif
    </div>
@endsection
