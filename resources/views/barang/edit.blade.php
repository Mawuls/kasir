@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
    <form action="{{ route('barang.update', $barangs->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
            <input type="text" name="nama_barang" value="{{ $barangs->nama_barang }}" class="mt-1 w-full border border-green-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="number" name="stock" value="{{ $barangs->stock }}" class="mt-1 w-full border border-green-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" name="harga" value="{{ $barangs->harga }}" class="mt-1 w-full border border-green-300 rounded px-3 py-2" required>
        </div>

        <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">Update</button>
    </form>
@endsection
