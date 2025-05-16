<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_address' => 'required|string',
            'payment_type' => 'required|in:credit_card,paypal,bank_transfer',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_address' => $validated['customer_address'],
            'payment_type' => $validated['payment_type'],
            'total_amount' => $totalAmount,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);

            $product = Product::find($item['id']);
            $product->stock_quantity -= $item['quantity'];
            $product->save();
        }

        session()->forget('cart');

        return redirect()->route('orders.confirmation', $order)
            ->with('success', 'Order placed successfully!');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function confirmation(Order $order)
    {
        return view('orders.confirmation', compact('order'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
