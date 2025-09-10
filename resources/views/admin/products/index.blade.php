@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Produtos da Loja</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">➕ Add Product</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>€{{ number_format($product->price, 2, ',', '.') }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" width="80">
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to remove this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No product found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
