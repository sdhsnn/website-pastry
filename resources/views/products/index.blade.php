@extends('layouts.app')

@section('content')
<div class="container mt-5" style="background-color:#f4ece2; min-height:80vh; padding:2rem; border-radius:0.5rem;">
    <div class="card border-0 shadow-sm rounded bg-[#f4ece2]">
        <div class="card-body">
            <a href="{{ route('products.create') }}" class="btn btn-md text-white mb-3" style="background-color:#B38867;">ADD PRODUCT</a>
            <table class="table table-bordered bg-white">
                <thead class="bg-[#B38867] text-white">
                    <tr>
                        <th scope="col">IMAGE</th>
                        <th scope="col">TITLE</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">STOCK</th>
                        <th scope="col" style="width: 20%">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="text-center">
                                <img src="{{ asset('/storage/products/'.$product->image) }}" class="rounded" style="width: 150px">
                            </td>
                            <td>{{ $product->title }}</td>
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
                            <td colspan="5" class="text-center text-red-600">
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

<script>
    // SweetAlert messages
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
