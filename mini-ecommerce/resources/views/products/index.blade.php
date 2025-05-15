@extends('layouts.app')
@section('content')
<div class="grid grid-cols-3 gap-6">
  @foreach($products as $product)
    <div class="product-card bg-white p-4 rounded shadow">
      <img src="{{ $product->image?asset('storage/'.$product->image):'https://via.placeholder.com/150' }}"
           class="h-32 w-full object-cover rounded">
      <h3 class="mt-2 font-semibold">{{ $product->name }}</h3>
      <p class="text-gray-700">${{ $product->price }}</p>
      <div class="mt-2 flex">
        <a href="{{ route('products.show',$product) }}" class="text-blue-500 mr-2">View</a>
        @auth
          <a href="{{ route('products.edit',$product) }}" class="text-green-500 mr-2">Edit</a>
          <form action="{{ route('products.destroy',$product) }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button class="text-red-500">Delete</button>
          </form>
        @endauth
      </div>
      <form action="{{ route('cart.add',$product) }}" method="POST" class="mt-2">
        @csrf
        <button class="w-full bg-blue-600 text-white py-1 rounded">Add to Cart</button>
      </form>
    </div>
  @endforeach
</div>
<div class="mt-6">{{ $products->links() }}</div>
@endsection
