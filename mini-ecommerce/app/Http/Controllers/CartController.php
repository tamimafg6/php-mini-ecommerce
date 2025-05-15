<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller {
    public function add(Product $product){
        $cart = session()->get('cart', []);
        $id = $product->id;
        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name'=>$product->name,
                'quantity'=>1,
                'price'=>$product->price,
                'image'=>$product->image
            ];
        }
        session()->put('cart',$cart);
        return back()->with('success','Added to cart');
    }

    public function index(){
        return view('cart.index', ['cart'=>session()->get('cart',[])]);
    }

    public function update(Request $request, Product $product){
        $cart = session()->get('cart', []);
        if(isset($cart[$product->id])){
            $cart[$product->id]['quantity'] = $request->quantity;
            session()->put('cart',$cart);
        }
        return back()->with('success','Cart updated');
    }

    public function remove(Product $product){
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart',$cart);
        return back()->with('success','Removed from cart');
    }
}
