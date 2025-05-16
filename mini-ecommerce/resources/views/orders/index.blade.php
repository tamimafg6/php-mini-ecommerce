@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Order Management</h1>

        <<div class="card">
        <div class="card-body">
            @if($orders->count())
            <div class="table-responsive">
                <table class="table">
                    <thead>
                      <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                      <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td>
                          <span class="badge bg-info">
                            {{ ucfirst(str_replace('_',' ',$order->payment_type)) }}
                          </span>
                        </td>
                        <td>
                          <div class="d-flex gap-2">
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="btn btn-primary btn-sm">
                              <i class="fas fa-eye"></i> View
                            </a>

                            <form action="{{ route('admin.orders.destroy', $order) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this order?')">
                              @csrf
                              @method('DELETE')
                              <button type="submit"
                                      class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete
                              </button>
                            </form>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
            @else
            <div class="text-center py-4">
                <h3>No orders yet</h3>
                <p class="text-muted">Orders will appear here once customers start placing them.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
