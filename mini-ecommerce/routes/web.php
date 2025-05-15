<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Auth::routes();

// Products
Route::get('/', [ProductController::class,'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class,'show'])->name('products.show');
Route::resource('products', ProductController::class)->except(['index','show']);

// Cart
Route::post('cart/add/{product}',    [CartController::class,'add'])->name('cart.add');
Route::get('cart',                   [CartController::class,'index'])->name('cart.index');
Route::patch('cart/update/{product}',[CartController::class,'update'])->name('cart.update');
Route::delete('cart/remove/{product}',[CartController::class,'remove'])->name('cart.remove');

// Checkout & Orders
Route::get('checkout', [OrderController::class,'checkoutForm'])->name('checkout.form');
Route::post('checkout',[OrderController::class,'placeOrder'])->name('checkout.place');

// Admin orders
Route::middleware(['auth','can:admin'])->group(function(){
    Route::get('admin/orders',       [OrderController::class,'adminIndex'])->name('admin.orders.index');
    Route::get('admin/orders/{order}',[OrderController::class,'adminShow'])->name('admin.orders.show');
});
