@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Manage Products</h1>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    Add New Product
                </a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="input-group">
                    <input
                        type="text"
                        id="search"
                        class="form-control"
                        placeholder="Search products..."
                        aria-label="Search">
                    <button class="btn btn-outline-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4" id="products-container">
            @include('products.partials.product-list', ['products' => $products])
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput       = document.getElementById('search');
        const productsContainer = document.getElementById('products-container');
        let timeoutId;

        searchInput.addEventListener('input', function() {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(function() {
                const term = encodeURIComponent(searchInput.value.trim());
                axios.get(`{{ route('admin.products.search') }}?q=${term}`)
                     .then(res => {
                         productsContainer.innerHTML = res.data;
                         productsContainer.classList.add('fade-in');
                         setTimeout(() => productsContainer.classList.remove('fade-in'), 500);
                     })
                     .catch(err => console.error(err));
            }, 500);
        });
    });
    </script>
@endsection
