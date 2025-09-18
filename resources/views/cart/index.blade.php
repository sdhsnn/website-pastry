<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Keranjang Belanja - PASTRY & BAKERY</title>
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
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
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
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
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

  <!-- Content -->
  <main class="container mx-auto flex-grow px-6 py-12">
    <h1 class="text-4xl font-extrabold mb-8 text-[#B38867]">Keranjang Belanja</h1>

    @if(session('success'))
      <div class="mb-6 bg-green-200 text-green-800 px-4 py-3 rounded">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="mb-6 bg-red-200 text-red-800 px-4 py-3 rounded">
        {{ session('error') }}
      </div>
    @endif

    @if(count($cart) > 0)
      <form action="{{ url('cart.checkout') }}" method="POST">
        @csrf
        <div class="overflow-x-auto rounded-lg shadow-md">
          <table class="min-w-full bg-white rounded-lg">
            <thead>
              <tr class="bg-[#B38867] text-white text-left">
                <th class="py-3 px-6">Pilih</th>
                <th class="py-3 px-6">Produk</th>
                <th class="py-3 px-6">Harga</th>
                <th class="py-3 px-6">Jumlah</th>
                <th class="py-3 px-6">Subtotal</th>
                <th class="py-3 px-6">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $total = 0; @endphp
              @foreach($cart as $id => $item)
                @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                <tr class="border-b border-gray-200 hover:bg-[#f0e7d8]">
                  <td class="py-4 px-6">
                    <input type="checkbox" name="items[]" value="{{ $id }}" class="w-5 h-5 text-[#B38867] rounded focus:ring-[#B38867]">
                  </td>
                  <td class="py-4 px-6 font-semibold">{{ $item['title'] }}</td>
                  <td class="py-4 px-6">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                  <td class="py-4 px-6">{{ $item['quantity'] }}</td>
                  <td class="py-4 px-6 font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                  <td class="py-4 px-6">
                    <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">Hapus</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Total Harga & Tombol -->
        <div class="mt-8 flex flex-col md:flex-row justify-between items-center gap-4">
          <div class="text-2xl font-bold text-[#B38867]">
            Total: Rp {{ number_format($total, 0, ',', '.') }}
          </div>
          <div class="flex gap-4">
            <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Yakin kosongkan keranjang?');">
              @csrf
              <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded font-semibold hover:bg-yellow-600 transition">Kosongkan</button>
            </form>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded font-semibold hover:bg-green-700 transition">Checkout</button>
          </div>
        </div>
      </form>
    @else
      <p class="text-xl text-center text-gray-600 mt-20">Keranjang Anda masih kosong.</p>
    @endif
  </main>

  <!-- Footer -->
  <footer class="bg-[#B38867] text-white text-center py-4 mt-auto">
    <p>© Copyright PASTRY&BAKERY. All Rights Reserved</p>
  </footer>

  <script>
    // Dropdown toggle
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
