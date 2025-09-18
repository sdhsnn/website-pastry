<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PASTRY & BAKERY</title>
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

        @auth
          <li class="relative">
            <button id="userDropdownBtn" class="flex items-center gap-1 focus:outline-none">
              <span>{{ Auth::user()->name }}</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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

  <!-- Hero Section -->
  <div class="relative">
    <img class="w-full h-[587px] object-cover" src="{{ asset('images/Rectangle 2.png') }}" alt="Hero Image" />
    <h1 class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-white text-[70px] font-extrabold text-center select-none">PASTRY & BAKERY</h1>
  </div>

  <!-- Best Seller Menu -->
  <section class="bg-[#B38867] text-white py-12">
    <h2 class="text-3xl text-center mb-10 font-semibold">Best Seller Menu</h2>
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 px-6 text-center">

      <div class="rounded-lg overflow-hidden shadow-lg bg-[#a97550] hover:scale-105 transform transition">
        <img src="{{ asset('images/crois.jpg') }}" alt="Croissant" class="w-full h-48 object-cover" />
        <p class="py-6 text-xl font-semibold">CROISSANT</p>
      </div>

      <div class="rounded-lg overflow-hidden shadow-lg bg-[#a97550] hover:scale-105 transform transition">
        <img src="{{ asset('images/crom.jpg') }}" alt="Cromboloni" class="w-full h-48 object-cover" />
        <p class="py-6 text-xl font-semibold">CROMBOLONI</p>
      </div>

      <div class="rounded-lg overflow-hidden shadow-lg bg-[#a97550] hover:scale-105 transform transition">
        <img src="{{ asset('images/bgl.jpg') }}" alt="Bagel" class="w-full h-48 object-cover" />
        <p class="py-6 text-xl font-semibold">BAGEL</p>
      </div>

      <div class="rounded-lg overflow-hidden shadow-lg bg-[#a97550] hover:scale-105 transform transition">
        <img src="{{ asset('images/muf.jpg') }}" alt="Muffin" class="w-full h-48 object-cover" />
        <p class="py-6 text-xl font-semibold">MUFFIN</p>
      </div>

    </div>
  </section>

  <!-- Contact Section -->
  <section class="bg-[#ddbc95] py-16">
    <h2 class="text-white text-3xl text-center mb-12 font-semibold">Contact</h2>
    <div class="container mx-auto flex flex-col sm:flex-row justify-center gap-8 px-6 max-w-4xl">

      <div class="flex gap-4 bg-[#b38867] rounded-lg p-8 items-center w-full sm:w-72 shadow-lg hover:bg-[#9a6e4b] transition">
        <img class="h-12" src="{{ asset('images/download (1).png') }}" alt="WhatsApp Icon" />
        <div class="text-white">
          <p class="font-semibold">WhatsApp</p>
          <p>+62 859-8523-5543</p>
        </div>
      </div>

      <div class="flex gap-4 bg-[#b38867] rounded-lg p-8 items-center w-full sm:w-72 shadow-lg hover:bg-[#9a6e4b] transition">
        <img class="h-12" src="{{ asset('images/download.png') }}" alt="Instagram Icon" />
        <div class="text-white">
          <p class="font-semibold">Instagram</p>
          <p>@pastrybakery</p>
        </div>
      </div>

    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-[#B38867] text-white text-center py-4">
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

    // Hide dropdowns on clicking outside
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
  