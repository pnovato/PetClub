@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Product</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erros:</strong>
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price">Price (€)</label>
            <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="quantity">Stock</label>
            <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.store') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
