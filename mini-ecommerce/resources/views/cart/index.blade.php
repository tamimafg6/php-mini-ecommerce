@extends('layouts.app')
@section('content')
<h2 class="text-xl mb-4">Your Cart</h2>
@if(!$cart)
  <p>Your cart is empty.</p>
@else
  <table class="w-full bg-white rounded shadow">
    <thead><tr>
      <th>Product</th><th>Qty</th><th>Price</th><th>Total</th><th>Action</th>
    </tr></thead>
    <tbody>
      @php $sum=0; @endphp
      @foreach($cart as $id=>$item)
        @php $total = $item['price']*$item['quantity']; $sum += $total; @endphp
        <tr>
          <td>{{ $item['name'] }}</td>
          <td>
            <form action="{{ route('cart.update',$id) }}" method="POST" class="inline">
              @csrf @method('PATCH')
              <input name="quantity" type="number" value="{{ $item['quantity'] }}" min="1" class="w-16 p-1 border">
              <button class="ml-2 text-blue-500">Update</button>
            </form>
          </td>
          <td>${{ $item['price'] }}</td>
          <td>${{ $total }}</td>
          <td>
            <form action="{{ route('cart.remove',$id) }}" method="POST">
              @csrf @method('DELETE')
              <button class="text-red-500">Remove</button>
            </form>
          </td>
        </tr>
      @endforeach
      <tr>
        <td colspan="3" class="font-bold">Grand Total</td>
        <td colspan="2" class="font-bold">${{ $sum }}</td>
      </tr>
    </tbody>
  </table>
  <a href="{{ route('checkout.form') }}" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded">Checkout</a>
@endif
@endsection
