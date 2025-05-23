@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<a href="{{ route('transaksi.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mb-4 inline-block">
    + Transaksi Baru
</a>

<div class="space-y-6">
    @forelse ($groupedTransaksis as $tanggal => $transaksis)
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <div class="px-6 py-4 bg-green-100 text-green-800 font-semibold flex justify-between items-center">
                <span>Nota Tanggal: {{ \Carbon\Carbon::parse($tanggal)->format('d M Y H:i') }}</span>
                <button 
                    data-url="{{ route('transaksi.show', $tanggal) }}"
                    class="btn-lihat-nota bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                    Lihat Nota
                </button>
              <a href="{{ route('transaksi.cetakPdf', $tanggal) }}" 
                class="bg-green-600 hover:bg-green-700 text-white px-2 py-2 rounded font-semibold">
                📄 Cetak PDF
                </a>

            </div>

            <table class="w-full text-sm text-left">
                <thead class="bg-green-50">
                    <tr>
                        <th class="p-3">Barang</th>
                        <th class="p-3">Jumlah</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Diskon</th>
                        <th class="p-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($transaksis as $trx)
                        <tr class="border-b hover:bg-green-50">
                            <td class="p-3">{{ $trx->barang->nama_barang }}</td>
                            <td class="p-3">{{ $trx->jumlah }}</td>
                            <td class="p-3">Rp {{ number_format($trx->harga_satuan) }}</td>
                            <td class="p-3">{{ $trx->diskon_saat_ini }}%</td>
                            <td class="p-3">Rp {{ number_format($trx->total_pembelian) }}</td>
                            @php $total += $trx->total_pembelian; @endphp
                        </tr>
                    @endforeach
                    <tr class="bg-green-100 font-semibold">
                        <td colspan="4" class="p-3 text-right">Total Nota</td>
                        <td class="p-3">Rp {{ number_format($total) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @empty
        <div class="text-gray-600">Belum ada transaksi.</div>
    @endforelse
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.btn-lihat-nota').forEach(button => {
        button.addEventListener('click', function () {
            const url = this.getAttribute('data-url');
            Swal.fire({
                title: 'Nota Transaksi',
                html: '<iframe src="' + url + '" class="w-full h-96" frameborder="0"></iframe>',
                width: '60%',
                showConfirmButton: false,
            });
        });
    });
</script>

@endsection
