<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Transaksi Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f9f9f9] font-sans p-10 min-h-screen">

    <h1 class="text-3xl font-bold text-center mb-3 text-[#4CAF50]">🎉 Transaksi Berhasil!</h1>

    @if(session('success'))
        <p class="text-green-500 text-center text-sm mb-6">{{ session('success') }}</p>
    @endif

    @if($pesanan)
        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-auto mb-6 overflow-hidden">

            <!-- Header card -->
            <div class="bg-[#b38867] text-white text-center py-4 px-6">
                <h2 class="text-xl font-semibold tracking-wide">Pesanan dari {{ $pesanan->nama }}</h2>
            </div>

            <!-- Isi data -->
            <div class="px-6 py-5 text-gray-700 text-[16px] space-y-3">

                <div class="flex">
                    <div class="w-1/3 font-medium text-gray-800">Nama:</div>
                    <div class="w-2/3">{{ $pesanan->nama }}</div>
                </div>

                <div class="flex">
                    <div class="w-1/3 font-medium text-gray-800">Alamat:</div>
                    <div class="w-2/3">{{ $pesanan->alamat }}</div>
                </div>

                <div class="flex">
                    <div class="w-1/3 font-medium text-gray-800">Nomor HP:</div>
                    <div class="w-2/3">{{ $pesanan->no_hp ?? '-' }}</div>
                </div>

                <div class="flex">
                    <div class="w-1/3 font-medium text-gray-800">Produk:</div>
                    <div class="w-2/3">{{ $pesanan->produk }}</div>
                </div>

                <div class="flex">
                    <div class="w-1/3 font-medium text-gray-800">Jumlah:</div>
                    <div class="w-2/3">{{ $pesanan->jumlah }}</div>
                </div>

                <div class="flex text-sm text-gray-500">
                    <div class="w-1/3">Waktu Pesan:</div>
                    <div class="w-2/3">{{ $pesanan->created_at->format('d M Y H:i') }}</div>
                </div>

            </div>
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada pesanan.</p>
    @endif

    <div class="text-center mt-8">
        <a href="{{ route('form') }}" 
           class="inline-block bg-[#b38867] hover:bg-[#9d7352] text-white font-medium py-2 px-6 rounded-lg transition duration-300">
            Kembali ke Form
        </a>
        <a href="{{ url('beranda') }}"
           class="inline-block bg-[#b38867] hover:bg-[#9d7352] text-white font-medium py-2 px-6 rounded-lg transition duration-300">
            Kembali ke Beranda
        </a>
    </div>

</body>
</html>
