<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white p-6 text-gray-800">
    <h1 class="text-xl font-bold mb-4">Nota Transaksi</h1>

    <p><strong>Tanggal:</strong> {{ $transaksis->tanggal_pembelian }}</p>
    <p><strong>Nama Barang:</strong> {{ $transaksis->barang->nama_barang }}</p>
    <p><strong>Jumlah:</strong> {{ $transaksis->jumlah }}</p>
    <p><strong>Harga Satuan:</strong> Rp {{ number_format($transaksis->harga_satuan) }}</p>
    <p><strong>Diskon per Item:</strong> {{ number_format($transaksis->diskon_saat_ini) }}%</p>
    <p><strong>Harga Setelah Diskon:</strong> Rp {{ number_format($transaksis->harga_setelah_diskon) }}</p>
    <p><strong>Total Pembelian:</strong> Rp {{ number_format($transaksis->total_pembelian) }}</p>
</body>
</html>
