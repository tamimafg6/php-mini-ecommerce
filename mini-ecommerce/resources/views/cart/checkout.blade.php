@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Checkout</h1>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Shipping Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required>
                                @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="customer_email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('customer_email') is-invalid @enderror" id="customer_email" name="customer_email" value="{{ old('customer_email', auth()->user()->email ?? '') }}" required>
                                @error('customer_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="customer_address" class="form-label">Shipping Address</label>
                                <textarea class="form-control @error('customer_address') is-invalid @enderror" id="customer_address" name="customer_address" rows="3" required>{{ old('customer_address') }}</textarea>
                                @error('customer_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Payment Method</label>
                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_type" id="payment_credit_card" value="credit_card" checked>
                                        <label class="form-check-label" for="payment_credit_card">
                                            Credit Card
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_type" id="payment_paypal" value="paypal">
                                        <label class="form-check-label" for="payment_paypal">
                                            PayPal
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_type" id="payment_bank_transfer" value="bank_transfer">
                                        <label class="form-check-label" for="payment_bank_transfer">
                                            Bank Transfer
                                        </label>
                                    </div>
                                </div>
                                @error('payment_type')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i> This is a demo store. No real payment will be processed.
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Back to Cart
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-credit-card me-2"></i> Place Order
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            @php $total = 0 @endphp
                            @foreach($cart as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <div class="d-flex justify-content-between mb-2">
                                    <span>{{ $details['name'] }} (x{{ $details['quantity'] }})</span>
                                    <span>${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-0">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
