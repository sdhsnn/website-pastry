@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center" style="color:#B38867;">Riwayat Pesanan</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle table-custom">
            <thead class="text-center">
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
                                <button class="btn btn-danger btn-sm" type="submit" title="Hapus Pesanan">
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
@endsection
