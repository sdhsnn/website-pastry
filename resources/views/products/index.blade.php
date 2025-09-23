@extends('layouts.app')

@section('content')
<div class="container mt-5" style="background-color:#f4ece2; min-height:80vh; padding:2rem; border-radius:0.5rem;">
    <div class="card border-0 shadow-sm rounded bg-[#f4ece2]">
        <div class="card-body">

            {{-- Bagian tombol di atas tabel --}}
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('products.create') }}" class="btn btn-md text-white" style="background-color:#B38867;">ADD PRODUCT</a>

                <div class="d-flex">
                    <a href="{{ route('products.export') }}" class="btn btn-success me-2">Export Excel</a>

                    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data" class="d-flex">
                        @csrf
                        <input type="file" name="file" required class="form-control me-2" style="max-width: 200px;">
                        <button type="submit" class="btn btn-primary">Import Excel</button>
                    </form>
                </div>
            </div>

            {{-- Tabel products --}}
            <table class="table table-bordered bg-white">
                <thead style="background-color:#B38867; color:white;">
                    <tr>
                        <th scope="col">IMAGE</th>
                        <th scope="col">TITLE</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">STOCK</th>
                        <th scope="col" style="width: 20%">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="text-center">
                                <img src="{{ asset('/storage/products/'.$product->image) }}" 
                                     class="rounded" style="width: 150px">
                            </td>
                            <td>{{ $product->title }}</td>
                            <td style="max-width: 300px; max-height: 120px; overflow: auto; text-align: justify; padding:0.5rem;">
                                {!! $product->description !!}
                            </td>
                            <td>{{ "Rp " . number_format($product->price,2,',','.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm text-white" style="background-color:#6b4f3b;">SHOW</a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm text-white" style="background-color:#B38867;">EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-white" style="background-color:#a23f2b;">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-danger">
                                Data Products belum Tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
</div>

{{-- Custom Scrollbar untuk deskripsi --}}
<style>
    td::-webkit-scrollbar {
        width: 6px;
    }
    td::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.3);
        border-radius: 10px;
    }
    td::-webkit-scrollbar-track {
        background: transparent;
    }
</style>

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
