@extends('layouts.app')

@section('title', 'Data Transaksi')

@section('content')
    <a href="{{ route('transaksi.create') }}" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 mb-4 inline-block">+ Tambah Transaksi</a>

    <table class="w-full mt-4 border border-green-200">
        <thead class="bg-green-100 text-green-900">
            <tr>
                <th class="py-2 px-4 border">Barang</th>
                <th class="py-2 px-4 border">Harga Asli</th>
                <th class="py-2 px-4 border">Diskon</th>
                <th class="py-2 px-4 border">Harga Diskon</th>
                <th class="py-2 px-4 border">Total</th>
                <th class="py-2 px-4 border">Keuntungan</th>
                <th class="py-2 px-4 border">Tanggal</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $t)
                <tr class="text-center">
                    <td class="py-2 px-4 border">{{ $t->barang->nama_barang }}</td>
                    <td class="py-2 px-4 border">{{ $t->harga_asli }}</td>
                    <td class="py-2 px-4 border">{{ $t->barang->diskon_saat_ini }}%</td>
                    <td class="py-2 px-4 border">{{ $t->harga_diskon }}</td>
                    <td class="py-2 px-4 border">{{ $t->total_pembelian }}</td>
                    <td class="py-2 px-4 border">{{ $t->keuntungan }}</td>
                    <td class="py-2 px-4 border">{{ $t->tanggal_pembelian }}</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('transaksi.edit', $t->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Hapus transaksi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
