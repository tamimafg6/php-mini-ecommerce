@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Products</h1>
            </div>
            @auth
                <div class="col-md-4 text-end">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
                </div>
            @endauth
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="input-group">
                    <input type="text" id="search" class="form-control" placeholder="Search products..." aria-label="Search">
                    <button class="btn btn-outline-primary" type="button" id="button-addon2">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4" id="products-container">
            @foreach($products as $product)
                <div class="col">
                    <div class="card h-100 product-card">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top product-image" alt="{{ $product->name }}">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <p class="text-muted">No image</p>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ $product->category->name ?? 'No Category' }}</p>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <p class="card-text fw-bold">${{ number_format($product->price, 2) }}</p>
                            <p class="card-text text-muted">Stock: {{ $product->stock_quantity }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary">View Details</a>
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-add-to-cart">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const productsContainer = document.getElementById('products-container');

            let searchTimeout;

            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);

                searchTimeout = setTimeout(function() {
                    const searchTerm = searchInput.value.trim();

                    axios.get(`/products/search?q=${searchTerm}`)
                        .then(response => {
                            productsContainer.innerHTML = response.data;
                            productsContainer.classList.add('fade-in');
                            setTimeout(() => {
                                productsContainer.classList.remove('fade-in');
                            }, 500);
                        })
                        .catch(error => {
                            console.error('Error fetching search results:', error);
                        });
                }, 500);
            });
        });
    </script>
@endsection
