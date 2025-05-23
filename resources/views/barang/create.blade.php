@extends('layouts.app')

@section('title', isset($barang) ? 'Edit Barang' : 'Tambah Barang')

@section('content')
<form action="{{ isset($barang) ? route('barang.update', $barang->id) : route('barang.store') }}" method="POST" class="space-y-4">
    @csrf
    @if(isset($barang))
        @method('PUT')
    @endif

    <div>
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="w-full p-2 border rounded" value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" required>
    </div>

    <div>
        <label>Harga</label>
        <input type="number" name="harga" class="w-full p-2 border rounded" value="{{ old('harga', $barang->harga ?? '') }}" required>
    </div>

    <div>
        <label>Diskon Saat Ini</label>
        <input type="number" name="diskon_saat_ini" class="w-full p-2 border rounded" value="{{ old('diskon_saat_ini', $barang->diskon_saat_ini ?? 0) }}" required>
    </div>

    <div>
        <label>Stock</label>
        <input type="number" name="stock" class="w-full p-2 border rounded" value="{{ old('stock', $barang->stock ?? '') }}" required>
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
</form>
@endsection
