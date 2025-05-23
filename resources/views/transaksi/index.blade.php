@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<a href="{{ route('transaksi.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mb-4 inline-block">+ Transaksi Baru</a>

<table class="min-w-full bg-white rounded-xl overflow-hidden shadow">
    <thead class="bg-green-100 text-green-800">
        <tr>
            <th class="p-3">Tanggal</th>
            <th class="p-3">Barang</th>
            <th class="p-3">Jumlah</th>
            <th class="p-3">Total</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksis as $trx)
            <tr class="border-b hover:bg-green-50">
                <td class="p-3">{{ $trx->tanggal_pembelian }}</td>
                <td class="p-3">{{ $trx->barang->nama_barang }}</td>
                <td class="p-3">{{ $trx->jumlah }}</td>
                <td class="p-3">Rp {{ number_format($trx->total_pembelian) }}</td>
                <td class="p-3">
                <button 
                data-url="{{ route('transaksi.show', $trx->id) }}"
                class="btn-lihat-nota bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Lihat Nota</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    document.querySelectorAll('.btn-lihat-nota').forEach(button => {
        button.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            lihatNota(url);
        });
    });

    function lihatNota(url) {
        Swal.fire({
            title: 'Nota Transaksi',
            html: '<iframe src="'+url+'" class="w-full h-96" frameborder="0"></iframe>',
            width: '60%',
            showConfirmButton: false,
        });
    }
</script>
@endsection
