@extends('layouts.app')

@section('content')
<div class="container mt-5" style="background-color:#f4ece2; min-height:80vh; padding:2rem; border-radius:0.5rem;">
    <div class="card border-0 shadow-sm rounded bg-[#f4ece2]">
        <div class="card-body">

            <h2 class="mb-4 text-center" style="color:#B38867;">Riwayat Pesanan</h2>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered bg-white align-middle">
                    <thead style="background-color:#B38867; color:white;" class="text-center">
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Waktu Pesan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pesanans as $pesanan)
                            <tr>
                                <td>{{ $pesanan->nama }}</td>
                                <td>{{ $pesanan->alamat }}</td>
                                <td>{{ $pesanan->no_hp }}</td>
                                <td>{{ $pesanan->produk }}</td>
                                <td class="text-center">{{ $pesanan->jumlah }}</td>
                                <td class="text-center">{{ $pesanan->created_at->format('d M Y H:i') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('riwayat.pesanan.destroy', $pesanan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm text-white" style="background-color:#a23f2b;" type="submit" title="Hapus Pesanan">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $pesanans->links() }}
            </div>

        </div>
    </div>
</div>

<script>
    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endsection
