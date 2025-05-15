@extends('layouts.app')
@section('content')
<h2 class="text-xl mb-4">Order #{{ $order->id }}</h2>
<p><strong>Customer:</strong> {{ $order->name }} ({{ $order->email }})</p>
<p><strong>Address:</strong> {{ $order->address }}</p>
<p><strong>Payment:</strong> {{ $order->payment_type }}</p>
<p><strong>Total:</strong> ${{ $order->total_amount }}</p>

<h3 class="mt-6 mb-2">Items</h3>
<table class="w-full bg-white rounded shadow">
  <thead><tr><th>Product</th><th>Qty</th><th>Price</th></tr></thead>
  <tbody>
    @foreach($order->items as $item)
      <tr>
        <td>{{ $item->product->name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>${{ $item->price }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
