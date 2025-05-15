@extends('layouts.app')
@section('content')
<h2 class="text-xl mb-4">Edit Product</h2>
<form action="{{ route('products.update',$product) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
  @csrf @method('PUT')
  <input name="name" class="w-full p-2 border" value="{{ old('name',$product->name) }}">
  <input name="category" class="w-full p-2 border" value="{{ old('category',$product->category) }}">
  <textarea name="description" class="w-full p-2 border">{{ old('description',$product->description) }}</textarea>
  <input name="price" type="number" step="0.01" class="w-full p-2 border" value="{{ old('price',$product->price) }}">
  <input name="stock_quantity" type="number" class="w-full p-2 border" value="{{ old('stock_quantity',$product->stock_quantity) }}">
  <img src="{{ asset('storage/'.$product->image) }}" class="h-16 mb-2">
  <input name="image" type="file" class="w-full">
  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
