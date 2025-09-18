<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Form Pemesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8f4ef]">

<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Form Pemesanan</h2>

    <!-- Pesan sukses -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Pesan error -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pesanan.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Nama -->
        <div>
            <label class="block font-semibold mb-1">Nama:</label>
            <input
                type="text"
                name="nama"
                value="{{ old('nama') }}"
                class="w-full border border-gray-300 p-2 rounded"
                required
            />
        </div>

        <!-- Alamat -->
        <div>
            <label class="block font-semibold mb-1">Alamat:</label>
            <textarea
                name="alamat"
                rows="3"
                class="w-full border border-gray-300 p-2 rounded"
                required
            >{{ old('alamat') }}</textarea>
        </div>

        <!-- No HP -->
        <div>
            <label class="block font-semibold mb-1">No HP:</label>
            <input
                type="text"
                name="no_hp"
                value="{{ old('no_hp') }}"
                placeholder="Contoh: 081234567890"
                class="w-full border border-gray-300 p-2 rounded"
                required
            />
        </div>

        <!-- Pilih Produk -->
        <div>
            <label class="block font-semibold mb-1">Produk:</label>

            @if(isset($selectedProductId))
                @php
                    $selectedProduct = $products->where('id', $selectedProductId)->first();
                @endphp

                @if($selectedProduct)
                    <input type="hidden" name="produk" value="{{ $selectedProduct->id }}">
                    <p class="font-semibold">{{ $selectedProduct->title }}</p>
                @else
                    <select
                        name="produk"
                        required
                        class="w-full border border-gray-300 rounded px-4 py-2"
                    >
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($products as $product)
                            <option
                                value="{{ $product->id }}"
                                {{ old('produk') == $product->id ? 'selected' : '' }}
                            >
                                {{ $product->title }}
                            </option>
                        @endforeach
                    </select>
                @endif
            @else
                <select
                    name="produk"
                    required
                    class="w-full border border-gray-300 rounded px-4 py-2"
                >
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($products as $product)
                        <option
                            value="{{ $product->id }}"
                            {{ old('produk') == $product->id ? 'selected' : '' }}
                        >
                            {{ $product->title }}
                        </option>
                    @endforeach
                </select>
            @endif
        </div>

        <!-- Jumlah -->
        <div>
    <label class="block font-semibold mb-1">Jumlah:</label>
    <input
        type="number"
        name="jumlah"
        value="{{ old('jumlah') }}"
        min="1"
        class="w-full border border-gray-300 p-2 rounded"
        required
    />
    @error('jumlah')
        <p class="text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>


        <!-- Tombol Kirim -->
        <div class="text-center pt-4">
            <button
                type="submit"
                class="bg-[#b38867] text-white font-medium py-2 px-6 rounded-full hover:bg-[#9d7352] transition duration-300"
            >
                Kirim Pesanan
            </button>
            <a href="{{ url('menuproduk') }}"
           class="bg-[#b38867] text-white font-medium py-2 px-6 rounded-full hover:bg-[#9d7352] transition duration-300"">
            Kembali ke Menu Produk
        </a>
        </div>
    </form>
</div>

</body>
</html>
