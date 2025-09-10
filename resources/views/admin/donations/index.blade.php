@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Donation History</h3>
    @if($donations->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Donor</th>
                <th>Amount (€)</th>
                <th>Date</th>
                <th>Receipt</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donations as $donation)
                <tr>
                    <td>{{ $donation->user->name ?? 'N/A' }}</td>
                    <td>{{ number_format($donation->amount, 2, ',', '.') }}</td>
                    <td>{{ $donation->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.donations.download', $donation->id) }}" class="btn btn-sm btn-primary">
                            Download
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
            <div class="d-flex justify-content-center mt-4">
                {{ $donations->links() }}
            </div> 
    </table>
    @else
        <p>No registry of donations.</p>
    @endif
</div>
@endsection
