@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Barang</label>
            <select name="id_barang" class="mt-1 w-full border border-green-300 rounded px-3 py-2" required>
                @foreach ($barangs as $barang)
                    <option value="{{ $barang->id }}" {{ $transaksi->id_barang == $barang->id ? 'selected' : '' }}>
                        {{ $barang->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Harga Asli</label>
            <input type="number" name="harga_asli" value="{{ $transaksi->harga_asli }}" class="mt-1 w-full border border-green-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Nominal Diskon</label>
            <input type="number" name="nominal_diskon" value="{{ $transaksi->nominal_diskon }}" class="mt-1 w-full border border-green-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Harga Setelah Diskon</label>
            <input type="number" name="harga_diskon" value="{{ $transaksi->harga_diskon }}" class="mt-1 w-full border border-green-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Total Pembelian</label>
            <input type="number" name="total_pembelian" value="{{ $transaksi->total_pembelian }}" class="mt-1 w-full border border-green-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Keuntungan</label>
            <input type="number" name="keuntungan" value="{{ $transaksi->keuntungan }}" class="mt-1 w-full border border-green-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal Pembelian</label>
            <input type="date" name="tanggal_pembelian" value="{{ $transaksi->tanggal_pembelian }}" class="mt-1 w-full border border-green-300 rounded px-3 py-2" required>
        </div>

        <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">Update</button>
    </form>
@endsection
