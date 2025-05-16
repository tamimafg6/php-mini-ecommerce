@foreach($products as $product)
    <div class="col">
        <div class="card h-100 product-card">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     class="card-img-top product-image"
                     alt="{{ $product->name }}">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px">
                    <p class="text-muted">No image</p>
                </div>
            @endif

            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text text-muted">
                    {{ $product->category->name ?? 'No Category' }}
                </p>
                <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                <p class="card-text fw-bold">${{ number_format($product->price,2) }}</p>
                <p class="card-text text-muted">Stock: {{ $product->stock_quantity }}</p>
            </div>

            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.products.edit', $product) }}"
                   class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="{{ route('admin.products.destroy', $product) }}"
                      method="POST"
                      onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endforeach
