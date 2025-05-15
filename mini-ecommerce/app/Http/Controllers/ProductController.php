<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
        $this->middleware('can:admin')->except(['index','show']);
    }

    public function index(){
        $products = Product::paginate(12);
        return view('products.index', compact('products'));
    }

    public function show(Product $product){
        return view('products.show', compact('product'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'category'=>'required',
            'description'=>'nullable',
            'price'=>'required|numeric',
            'stock_quantity'=>'required|integer',
            'image'=>'nullable|image|max:2048',
        ]);
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('products','public');
        }
        Product::create($data);
        return redirect()->route('products.index')->with('success','Product added.');
    }

    public function edit(Product $product){
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product){
        $data = $request->validate([
            'name'=>'required',
            'category'=>'required',
            'description'=>'nullable',
            'price'=>'required|numeric',
            'stock_quantity'=>'required|integer',
            'image'=>'nullable|image|max:2048',
        ]);
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('products','public');
        }
        $product->update($data);
        return redirect()->route('products.index')->with('success','Product updated.');
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('products.index')->with('success','Product removed.');
    }
}
