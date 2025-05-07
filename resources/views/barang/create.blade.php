@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-2xl font-semibold text-green-800 mb-4">Tambah Barang</h1>

        <form action="{{ route('barang.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nama_barang" class="block text-sm font-medium text-green-800 mb-1">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang"
                    class="w-full border border-green-500 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-300"
                    required>
            </div>

            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-green-800 mb-1">Harga</label>
                <input type="number" step="0.01" name="harga" id="harga"
                    class="w-full border border-green-500 rounded px-3 py-2 focus:outline-none" required>
            </div>

            <div class="mb-4">
                <label for="diskon" class="block text-sm font-medium text-green-800 mb-1">Diskon</label>
                <input type="number" name="diskon_saat_ini" required
                    class="w-full border border-green-500 rounded px-3 py-2 focus:outline-none" required>
            </div>

            <div class="mb-4">
                <label for="stock" class="block text-sm font-medium text-green-800 mb-1">Stock</label>
                <input type="number" name="stock" id="stock"
                    class="w-full border border-green-500 rounded px-3 py-2 focus:outline-none" required>
            </div>

            <button type="submit"
                class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 transition">Simpan</button>
        </form>
    </div>
</div>
@endsection
