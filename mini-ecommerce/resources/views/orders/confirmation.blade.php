@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        </div>
                        <h1 class="mb-3">Thank You!</h1>
                        <p class="lead mb-4">Your order has been placed successfully.</p>

                        <div class="alert alert-info mx-auto" style="max-width: 450px;">
                            <p class="mb-1"><strong>Order ID:</strong> #{{ $order->id }}</p>
                            <p class="mb-1"><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                            <p class="mb-0"><strong>Date:</strong> {{ $order->created_at->format('F d, Y h:i A') }}</p>
                        </div>

                        <p class="mb-4">A confirmation email has been sent to {{ $order->customer_email }}</p>

                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-bag me-2"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
