<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'description'    => 'required|string',
            'price'          => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($file = $request->file('image')) {
            $data['image'] = $file->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'description'    => 'required|string',
            'price'          => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($file = $request->file('image')) {
            $product->image && Storage::disk('public')->delete($product->image);
            $data['image'] = $file->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->image && Storage::disk('public')->delete($product->image);

        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('q', '');

        $products = Product::with('category')
            ->when($query, fn($q) =>
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhereHas('category', fn($c) =>
                      $c->where('name', 'like', "%{$query}%")
                  )
            )
            ->get();

        $html = view('products.partials.product-list', compact('products'))->render();

        return response($html);
    }

    public function adminSearch(Request $request)
{
    $query = $request->input('q', '');
    $products = Product::with('category')
        ->when($query, fn($q) =>
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%")
              ->orWhereHas('category', fn($c) =>
                  $c->where('name', 'like', "%{$query}%")
              )
        )
        ->get();

    return view('products.partials.product-list', compact('products'));
}

        public function adminIndex()
        {
            $products = Product::with('category')->latest()->paginate(10);

            return view('admin.products.index', compact('products'));
        }

}
