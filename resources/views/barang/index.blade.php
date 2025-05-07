@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
    <a href="{{ route('barang.create') }}" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 mb-4 inline-block">+ Tambah Barang</a>

    <table class="w-full mt-4 border border-green-200">
        <thead class="bg-green-100 text-green-900">
            <tr>
                <th class="py-2 px-4 border">Nama Barang</th>
                <th class="py-2 px-4 border">Stock</th>
                <th class="py-2 px-4 border">Harga</th>
                <th class="py-2 px-4 border">Diskon</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
                <tr class="text-center">
                    <td class="py-2 px-4 border">{{ $barang->nama_barang }}</td>
                    <td class="py-2 px-4 border">{{ $barang->stock }}</td>
                    <td class="py-2 px-4 border">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                    <td class="py-2 px-4 border">{{ $barang->diskon_saat_ini }}%</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('barang.edit', $barang->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin hapus barang ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
