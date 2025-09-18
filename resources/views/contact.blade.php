<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fdf6ee]">

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

<!-- Hero -->
<section class="bg-[#ddbc95] text-center py-10 text-white">
    <h1 class="text-4xl font-bold mb-4">Contact Us</h1>
    <p class="text-lg">We're happy to hear from you! Reach us through any of the channels below.</p>
</section>

<!-- Contact Cards -->
<section class="py-10 container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-[#b38867] text-white rounded-lg p-6 text-center items-center shadow-lg hover:bg-[#9a6e4b] transition">
        <img class="h-12 mx-auto mb-2" src="{{ asset('images/download (1).png') }}" alt="WhatsApp Logo" />
        <p class="text-lg font-semibold">WhatsApp</p>
        <p>+62 859-8523-5543</p>
    </div>
    <div class="bg-[#b38867] text-white rounded-lg p-6 text-center items-center shadow-lg hover:bg-[#9a6e4b] transition">
        <img class="h-12 mx-auto mb-2" src="{{ asset('images/download.png') }}" alt="Instagram Logo" />
        <p class="text-lg font-semibold">Instagram</p>
        <p>@pastrybakery</p>
    </div>
    <div class="bg-[#b38867] text-white rounded-lg p-6 text-center items-center shadow-lg hover:bg-[#9a6e4b] transition">
        <img class="h-14 mx-auto mb-2" src="{{ asset('images/email.png') }}" alt="Instagram Logo" />
        <p class="text-lg font-semibold">Email</p>
        <p>info@pastrybakery.com</p>
    </div>
</section>



<!-- Map + Hours -->
<section class="py-10 bg-[#f5e8da]">
    <div class="container mx-auto flex flex-col md:flex-row gap-10">
        <div class="w-full md:w-1/2">
            <h3 class="text-xl font-bold text-[#b38867] mb-4">Find Us</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.223577069697!2d107.91881257499597!3d-6.863788493134759!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68d1188634b1c3%3A0x7343ed66c26142ab!2sJembatan%20Babakan%20Regol!5e0!3m2!1sen!2sid!4v1754006997834!5m2!1sen!2sid" width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="w-full md:w-1/2">
            <h3 class="text-xl font-bold text-[#b38867] mb-4">Opening Hours</h3>
            <ul class="text-[#4b3f37] space-y-2">
                <li>Monday - Friday: 08.00 - 20.00</li>
                <li>Saturday: 08.00 - 18.00</li>
                <li>Sunday: Closed</li>
            </ul>
        </div>
    </div>
</section>



<!-- Footer -->
<footer class="bg-[#B38867] text-white text-center py-4">
    <p>© 2025 PASTRY&BAKERY. All Rights Reserved.</p>
</footer>

<!-- Dropdown & Form Validation Script -->
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
