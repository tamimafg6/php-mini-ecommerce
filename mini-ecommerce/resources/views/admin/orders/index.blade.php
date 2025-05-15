@extends('layouts.app')
@section('content')
<h2 class="text-xl mb-4">All Orders</h2>
<table class="w-full bg-white rounded shadow">
  <thead><tr>
    <th>#</th><th>Customer</th><th>Total</th><th>Date</th><th>Action</th>
  </tr></thead>
  <tbody>
    @foreach($orders as $order)
      <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->name }}<br>{{ $order->email }}</td>
        <td>${{ $order->total_amount }}</td>
        <td>{{ $order->created_at->format('Y-m-d') }}</td>
        <td><a href="{{ route('admin.orders.show',$order) }}" class="text-blue-500">View</a></td>
      </tr>
    @endforeach
  </tbody>
</table>
<div class="mt-4">{{ $orders->links() }}</div>
@endsection
