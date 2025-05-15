@extends('layouts.app')
@section('content')
<div class="bg-white p-6 rounded shadow">
  <img src="{{ $product->image?asset('storage/'.$product->image):'https://via.placeholder.com/300' }}"
       class="w-full h-64 object-cover rounded">
  <h2 class="text-2xl mt-4">{{ $product->name }}</h2>
  <p class="text-gray-700 mt-2">${{ $product->price }}</p>
  <p class="mt-2">{{ $product->description }}</p>
  <form action="{{ route('cart.add',$product) }}" method="POST" class="mt-4">
    @csrf
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Add to Cart</button>
  </form>
</div>
@endsection
