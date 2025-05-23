@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
<a href="{{ route('barang.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mb-4 inline-block">+ Tambah Barang</a>

<table class="min-w-full bg-white rounded-xl overflow-hidden shadow">
    <thead class="bg-green-100 text-green-800">
        <tr>
            <th class="p-3">Nama Barang</th>
            <th class="p-3">Harga</th>
            <th class="p-3">Diskon</th>
            <th class="p-3">Stock</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($barangs as $barang)
            <tr class="border-b hover:bg-green-50">
                <td class="p-3">{{ $barang->nama_barang }}</td>
                <td class="p-3">Rp {{ number_format($barang->harga) }}</td>
                <td class="p-3">{{ number_format($barang->diskon_saat_ini) }}%</td>
                <td class="p-3">{{ $barang->stock }}</td>
                <td class="p-3 space-x-2">
                    <a href="{{ route('barang.edit', $barang->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
