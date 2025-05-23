<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Nota Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: monospace, monospace;
            margin: 0;
            padding: 16px;
            background: #fff;
            color: #000;
            font-size: 18px;
            line-height: 1.5;
        }
        .struk-header {
            text-align: center;
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 12px;
            letter-spacing: 2px;
        }
        .date {
            font-size: 14px;
            margin-bottom: 16px;
            text-align: center;
            color: #555;
        }
        .line-dotted {
            border-bottom: 2px dotted #000;
            margin: 12px 0;
        }
        .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 18px;
        }
        .item-name {
            flex: 1 1 auto;
            font-weight: 600;
        }
        .item-qty-price {
            flex: 0 0 150px;
            text-align: right;
            font-weight: 500;
        }
        .item-discount {
            font-size: 14px;
            color: #666;
        }
        .summary {
            margin-top: 20px;
            border-top: 2px solid #000;
            padding-top: 12px;
            font-weight: 700;
            font-size: 24px;
            text-align: right;
        }
        .btn-cetak {
            display: block;
            width: max-content;
            margin: 24px auto 0;
            padding: 12px 24px;
            background-color: #2563eb;
            color: white;
            font-weight: 700;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            user-select: none;
            transition: background-color 0.3s ease;
        }
        .btn-cetak:hover {
            background-color: #1d4ed8;
        }
    </style>
</head>
<body>

    <div class="struk-header">
        NOTA TRANSAKSI
    </div>
    @if ($transaksis->isNotEmpty())
    <div class="date">
        {{ \Carbon\Carbon::parse($transaksis->first()->tanggal_pembelian)->format('d M Y H:i:s') }}
    </div>
@else
    <div class="date text-red-600">
        Tidak ada transaksi.
    </div>
@endif


    <div class="line-dotted"></div>

    @foreach ($transaksis as $trx)
        <div class="item">
            <div class="item-name">
                {{ $trx->barang->nama_barang }}<br />
                <span class="item-discount">Diskon: {{ $trx->diskon_saat_ini }}%</span>
            </div>
            <div class="item-qty-price">
                {{ $trx->jumlah }} x Rp {{ number_format($trx->harga_satuan,0,",",".") }}<br />
                <small>Rp {{ number_format($trx->harga_setelah_diskon,0,",",".") }}</small>
            </div>
        </div>
    @endforeach

    <div class="line-dotted"></div>

    @php
        $totalKeseluruhan = $transaksis->sum('total_pembelian');

        $totalDiskon = 0;
        foreach($transaksis as $trx) {
            $hargaSebelumDiskon = $trx->harga_satuan * $trx->jumlah;
            $hargaSetelahDiskon = $trx->harga_setelah_diskon * $trx->jumlah;
            $totalDiskon += $hargaSebelumDiskon - $hargaSetelahDiskon;
        }
    @endphp

    <div class="summary">
        <div>Total Diskon: Rp {{ number_format($totalDiskon,0,",",".") }}</div>
        <div class="mt-2">TOTAL BAYAR: Rp {{ number_format($totalKeseluruhan,0,",",".") }}</div>
    </div>

</body>
</html>
