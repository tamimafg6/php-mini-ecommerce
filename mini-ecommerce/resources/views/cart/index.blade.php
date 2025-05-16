@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Your Shopping Cart</h1>

        @if(count($cart) > 0)
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $total = 0 @endphp
                            @foreach($cart as $id => $details)
                                @php
                                    $subtotal = $details['price'] * $details['quantity'];
                                    $total += $subtotal;
                                @endphp
                                <tr data-id="{{ $id }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($details['image'])
                                                <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                            @endif
                                            <span>{{ $details['name'] }}</span>
                                        </div>
                                    </td>
                                    <td>${{ number_format($details['price'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="form-control form-control-sm" style="width: 70px;">
                                            <button type="submit" class="btn btn-sm btn-primary ms-2">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>${{ number_format($subtotal, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total:</td>
                                <td class="fw-bold">${{ number_format($total, 2) }}</td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                        </a>
                        <a href="{{ route('cart.checkout') }}" class="btn btn-success">
                            Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body text-center py-5">
                    <h3 class="mb-3">Your cart is empty!</h3>
                    <p class="mb-4">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-bag me-2"></i> Start Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
