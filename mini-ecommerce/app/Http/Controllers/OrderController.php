<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller {
    public function checkoutForm(){
        return view('checkout');
    }

    public function placeOrder(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'address'=>'required',
            'payment_type'=>'required'
        ]);
        $cart = session()->get('cart',[]);
        $total = array_sum(array_map(fn($i)=>$i['price']*$i['quantity'],$cart));
        $order = Order::create(array_merge($data, [
            'user_id'=>auth()->id(),
            'total_amount'=>$total
        ]));
        foreach($cart as $id=>$item){
            $order->items()->create([
                'product_id'=>$id,
                'quantity'=>$item['quantity'],
                'price'=>$item['price']
            ]);
            Product::find($id)->decrement('stock_quantity',$item['quantity']);
        }
        session()->forget('cart');
        return redirect()->route('products.index')->with('success','Order placed!');
    }

    public function adminIndex(){
        $orders = Order::with('items.product')->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function adminShow(Order $order){
        $order->load('items.product');
        return view('admin.orders.show', compact('order'));
    }
}
