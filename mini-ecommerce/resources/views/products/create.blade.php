@extends('layouts.app')
@section('content')
<h2 class="text-xl mb-4">Add Product</h2>
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
  @csrf
  <input name="name" placeholder="Name" class="w-full p-2 border" value="{{ old('name') }}">
  <input name="category" placeholder="Category" class="w-full p-2 border" value="{{ old('category') }}">
  <textarea name="description" placeholder="Description" class="w-full p-2 border">{{ old('description') }}</textarea>
  <input name="price" type="number" step="0.01" placeholder="Price" class="w-full p-2 border" value="{{ old('price') }}">
  <input name="stock_quantity" type="number" placeholder="Stock Qty" class="w-full p-2 border" value="{{ old('stock_quantity') }}">
  <input name="image" type="file" class="w-full">
  <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
</form>
@endsection
