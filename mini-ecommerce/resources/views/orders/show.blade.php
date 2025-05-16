@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order #{{ $order->id }}</li>
            </ol>
        </nav>

        <div class="row mb-4">
            <div class="col-md-6">
                <h1>Order #{{ $order->id }}</h1>
                <p class="text-muted">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
            </div>
            <div class="col-md-6 text-md-end">
                <span class="badge bg-info fs-6">{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Order Items</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>${{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Total:</td>
                                    <td class="fw-bold">${{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Customer Information</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                        <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                        <p><strong>Address:</strong> {{ $order->customer_address }}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                        <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                        <p><strong>Time:</strong> {{ $order->created_at->format('h:i A') }}</p>
                        <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</p>
                        <p class="mb-0"><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
