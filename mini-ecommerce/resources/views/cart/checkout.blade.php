@extends('layouts.app')
@section('content')
<h2 class="text-xl mb-4">Checkout</h2>
<form action="{{ route('checkout.place') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
  @csrf
  <input name="name" placeholder="Full Name" class="w-full p-2 border" value="{{ old('name') }}">
  <input name="email" placeholder="Email" class="w-full p-2 border" value="{{ old('email') }}">
  <textarea name="address" placeholder="Address" class="w-full p-2 border">{{ old('address') }}</textarea>
  <select name="payment_type" class="w-full p-2 border">
    <option value="">Payment Type</option>
    <option>Credit Card</option>
    <option>PayPal</option>
    <option>Cash on Delivery</option>
  </select>
  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Place Order</button>
</form>
@endsection
