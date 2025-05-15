<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Mini E-Commerce</title>
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
<nav class="bg-white p-4 shadow flex justify-between">
  <a href="{{ route('products.index') }}" class="font-bold text-xl">Tech Gadgets</a>
  <input id="search" type="text" placeholder="Search…" class="px-2 py-1 border rounded"
         onkeyup="filterProducts()">
  <div>
    <a href="{{ route('cart.index') }}" class="mr-4">Cart({{ count(session('cart',[])) }})</a>
    @guest
      <a href="{{ route('login') }}" class="mr-2">Login</a>
      <a href="{{ route('register') }}">Register</a>
    @else
      @if(auth()->user()->is_admin)
        <a href="{{ route('admin.orders.index') }}" class="mr-4">Orders</a>
      @endif
      <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
    @endguest
  </div>
</nav>
<main class="p-6">
  @if(session('success'))
    <div class="mb-4 p-2 bg-green-200">{{ session('success') }}</div>
  @endif
  @yield('content')
</main>
<script>
  function filterProducts(){
    let q = document.getElementById('search').value.toLowerCase();
    document.querySelectorAll('.product-card').forEach(c=>{
      c.style.display = c.innerText.toLowerCase().includes(q)?'block':'none';
    });
  }
</script>
</body>
</html>
