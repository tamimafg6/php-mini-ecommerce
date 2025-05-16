@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-5">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 400px;">
                        <p class="text-muted">No image</p>
                    </div>
                @endif
            </div>
            <div class="col-md-7">
                <h1 class="mb-3">{{ $product->name }}</h1>
                <p class="text-muted mb-3">Category: {{ $product->category->name ?? 'No Category' }}</p>
                <p class="mb-4">{{ $product->description }}</p>
                <h3 class="mb-3">${{ number_format($product->price, 2) }}</h3>

                <div class="mb-3">
                    <p class="mb-1">Availability:</p>
                    @if($product->stock_quantity > 0)
                        <p class="text-success fw-bold">In Stock ({{ $product->stock_quantity }} available)</p>
                    @else
                        <p class="text-danger fw-bold">Out of Stock</p>
                    @endif
                </div>

                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg" {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                        <i class="fas fa-cart-plus me-2"></i> Add to Cart
                    </button>
                </form>

                @auth
                    <div class="mt-5 d-flex">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-primary me-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
