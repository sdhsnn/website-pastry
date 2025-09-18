<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f4ece2] min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-[#B38867] w-full shadow">
        <div class="container mx-auto flex justify-between items-center px-6 py-4">
            <h2 class="text-white text-2xl font-bold">PASTRY & BAKERY</h2>
            <ul class="flex space-x-8 text-white text-xl font-bold">
                <li><a href="{{ url('/beranda') }}" class="hover:text-[#ddbc95] transition-colors">Home</a></li>
                <li><a href="{{ url('/menuproduk') }}" class="hover:text-[#ddbc95] transition-colors">Menu</a></li>
                <li><a href="{{ url('/kontak') }}" class="hover:text-[#ddbc95] transition-colors">Contact</a></li>
                <li><a href="{{ route('cart.index') }}" class="hover:text-[#ddbc95] transition-colors">Cart</a></li>

                @auth
                <li class="relative">
                    <button id="userDropdownBtn" class="flex items-center gap-1 focus:outline-none">
                        <span>{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <ul id="userDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg text-black text-sm hidden z-10">
                        <li><a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-[#B38867] hover:text-white rounded-t-lg">Dashboard</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-[#B38867] hover:text-white rounded-b-lg">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth

                @guest
                <li class="relative">
                    <button id="accountDropdownBtn" class="flex items-center gap-1 focus:outline-none">
                        <span>Account</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <ul id="accountDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg text-black text-sm hidden z-10">
                        <li><a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-[#B38867] hover:text-white rounded-t-lg">Login</a></li>
                        <li><a href="{{ route('register') }}" class="block px-4 py-2 hover:bg-[#B38867] hover:text-white rounded-b-lg">Register</a></li>
                    </ul>
                </li>
                @endguest
            </ul>
        </div>
    </nav>

    <!-- Produk Section -->
    <main class="flex-grow bg-[#ddbc95] py-12 px-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
            <div class="bg-white shadow-lg rounded-2xl p-4 flex flex-col justify-between">
                <img src="{{ asset('/storage/products/'.$product->image) }}" 
                     alt="{{ $product->title }}" 
                     class="w-full h-48 object-cover rounded-lg mb-4">

                <h2 class="text-lg font-bold text-gray-800 mb-2">{{ $product->title }}</h2>
                <p class="text-gray-600 mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="text-gray-700 mb-2">Stok: {{ $product->stock }}</p>
                <p class="text-gray-600 mb-4">{!! $product->description !!}</p>

                @if ($product->stock > 0)
                <form method="POST" action="{{ route('cart.add') }}" class="mt-auto">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="flex items-center justify-between mb-4 bg-gray-100 rounded-xl px-2 py-2">
                        <button type="button" 
                                class="decrement w-10 h-10 flex items-center justify-center bg-white rounded-xl shadow hover:bg-gray-200 font-bold text-lg"
                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                            -
                        </button>
                        <input type="number" 
                               name="quantity" 
                               value="1" 
                               min="1" 
                               max="{{ $product->stock }}" 
                               class="w-16 text-center border-none bg-transparent font-semibold text-gray-700 text-lg focus:outline-none">
                        <button type="button" 
                                class="increment w-10 h-10 flex items-center justify-center bg-white rounded-xl shadow hover:bg-gray-200 font-bold text-lg"
                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                            +
                        </button>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('form', ['product_id' => $product->id]) }}" class="flex-1">
                            <button type="button" 
                                    class="bg-[#E1C3A7] text-[#302A2D] px-4 py-2 rounded-xl hover:bg-[#873e23] hover:text-white transition font-semibold w-full">
                                Order
                            </button>
                        </a>
                        <button type="submit" 
                                class="flex-1 bg-[#B38867] hover:bg-[#9a6e4b] text-white px-4 py-2 rounded-xl w-full font-semibold transition">
                            Add to Cart
                        </button>
                    </div>
                </form>
                @else
                <div class="mt-auto bg-red-100 text-red-700 font-semibold text-center py-3 rounded-xl">
                    Stok Habis
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </main>

    <footer class="bg-[#B38867] text-white text-center py-4">
        <p>© Copyright PASTRY & BAKERY. All Rights Reserved</p>
    </footer>

    <script>
        document.getElementById('userDropdownBtn')?.addEventListener('click', function (event) {
            document.getElementById('userDropdown').classList.toggle('hidden');
            event.stopPropagation();
        });

        document.getElementById('accountDropdownBtn')?.addEventListener('click', function (event) {
            document.getElementById('accountDropdown').classList.toggle('hidden');
            event.stopPropagation();
        });

        document.addEventListener('click', function (event) {
            const userDropdown = document.getElementById('userDropdown');
            const accountDropdown = document.getElementById('accountDropdown');
            if (userDropdown && !userDropdown.contains(event.target) && !event.target.closest('#userDropdownBtn')) {
                userDropdown.classList.add('hidden');
            }
            if (accountDropdown && !accountDropdown.contains(event.target) && !event.target.closest('#accountDropdownBtn')) {
                accountDropdown.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
