@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Our Pet Products</h2>
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($product->image)
                        <img src="{{ asset('storage/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>€{{ number_format($product->price, 2, ',', '.') }}</strong></p>
                        @if($product->quantity > 0)
                            <form action="{{ route('store.payment') }}" method="POST" class="mt-auto">
                            @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="mb-2">
                                        <label for="quantity-{{ $product->id }}" class="form-label">Units:</label>
                                        <input type="number" name="quantity" id="quantity-{{ $product->id }}" class="form-control" value="1" min="1" max="{{ $product->quantity }}" style="width: 80px;">
                                    </div>
                                    @guest
                                            <label for="email">E-mail:</label>
                                            <input type="email" name="email" id="email" required>
                                    @endguest
                                <button type="submit" class="btn btn-primary w-100">Buy</button>
                            </form>
                        @else
                            <span class="btn btn-secondary disabled mt-auto">Sold Out</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p>No available products at the moment.</p>
        @endforelse
    </div>
</div>
@endsection
