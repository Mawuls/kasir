@extends('layouts.app')

@section('content')
<div class="container mt-4">
    
    <h1 class="text-2xl font-semibold text-green-800 mb-4">Tambah Transaksi</h1>

        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="id_barang" class="block text-sm font-medium text-green-800 mb-1">Barang</label>
                <select name="id_barang" id="id_barang" class="w-full border border-green-500 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-300" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="harga_asli" class="block text-sm font-medium text-green-800 mb-1">Harga Asli</label>
                <input type="text" name="harga_asli" id="harga_asli" class="w-full border border-green-500 rounded px-3 py-2 focus:outline-none" required>
            </div>

            <div class="mb-4">
                <label for="nominal_diskon" class="block text-sm font-medium text-green-800 mb-1">Diskon</label>
                <select name="nominal_diskon" id="nominal_diskon" class="w-full border border-green-500 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-green-300" required>
                    <option value="">-- Pilih Diskon --</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->diskon_saat_ini }}%</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="harga_diskon" class="block text-sm font-medium text-green-800 mb-1">Harga Setelah Diskon</label>
                <input type="text" name="harga_diskon" id="harga_diskon" class="w-full border border-green-500 rounded px-3 py-2 focus:outline-none" required>
            </div>

            <div class="mb-4">
                <label for="total_pembelian" class="block text-sm font-medium text-green-800 mb-1">Total Pembelian</label>
                <input type="text" name="total_pembelian" id="total_pembelian" class="w-full border border-green-500 rounded px-3 py-2 focus:outline-none" required>
            </div>

            <div class="mb-4">
                <label for="keuntungan" class="block text-sm font-medium text-green-800 mb-1">Keuntungan</label>
                <input type="text" name="keuntungan" id="keuntungan" class="w-full border border-green-500 rounded px-3 py-2 focus:outline-none" required>
            </div>

            <div class="mb-4">
                <label for="tanggal_pembelian" class="block text-sm font-medium text-green-800 mb-1">Tanggal Pembelian</label>
                <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="w-full border border-green-500 rounded px-3 py-2 focus:outline-none" required>
            </div>

            <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">Simpan</button>
            @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Nota Berhasil Dibuat!',
            text: '{{ session('success') }}';
        });
    </script>
@endif

        </form>
    </div>
</div>
@endsection
