@extends('layouts.app')

@section('title', 'Buat Transaksi')

@section('content')
<form action="{{ route('transaksi.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label>Barang</label>
        <select name="id_barang" class="w-full p-2 border rounded" required>
            <option value="">Pilih Barang</option>
            @foreach($barangs as $barang)
                <option value="{{ $barang->id }}">{{ $barang->nama_barang }} (Stok: {{ $barang->stock }})</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Jumlah</label>
        <input type="number" name="jumlah" class="w-full p-2 border rounded" required>
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan Transaksi</button>
</form>
@endsection
