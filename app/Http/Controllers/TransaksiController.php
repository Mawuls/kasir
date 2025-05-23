<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Support\Facades\Date;


class TransaksiController extends Controller
{
    public function cetakPdf($tanggal)
{
   $transaksis = Transaksi::with('barang')
        ->where('tanggal_pembelian', $tanggal)
        ->get();

        
        if ($transaksis->isEmpty()) {
            return back()->with('error', 'Tidak ada transaksi pada tanggal tersebut.');
        }
        
        $pdf = PDF::loadView('transaksi.show', [
            'transaksis' => $transaksis,
            'tanggal' => $tanggal
        ]);

    return $pdf->download('print_transaksi_' . $tanggal . '.pdf');
}


    public function index()
    {

        $groupedTransaksis = Transaksi::with('barang')
            ->orderBy('tanggal_pembelian', 'desc')
            ->get()
            ->groupBy('tanggal_pembelian');

        return view('transaksi.index', compact('groupedTransaksis'));

    }

    public function create()
    {
        $barangs = Barang::all();
        return view('transaksi.create', compact('barangs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'barangs' => 'required|array',
            'barangs.*.id' => 'required|exists:barangs,id',
            'barangs.*.jumlah' => 'required|integer|min:1',
        ]);

        foreach ($request->barangs as $barangData) {
            $barang = Barang::findOrFail($barangData['id']);
            $jumlah = $barangData['jumlah'];

            if ($barang->stock < $jumlah) {
                return back()->withErrors(['stok' => "Stok tidak cukup untuk {$barang->nama_barang}"]);
            }

            

            $hargaSatuan = $barang->harga;
            $diskonSaatIni = $barang->diskon_saat_ini ?? 0;
            $hargaSetelahDiskon = $hargaSatuan - ($hargaSatuan * $diskonSaatIni / 100);
            $totalPembelian = $hargaSetelahDiskon * $jumlah;

            $barang->decrement('stock', $jumlah);
            $barang->refresh();

            Transaksi::create([
                'id_barang' => $barang->id,
                'jumlah' => $jumlah,
                'harga_satuan' => $hargaSatuan,
                'diskon_saat_ini' => $diskonSaatIni,
                'harga_setelah_diskon' => $hargaSetelahDiskon,
                'total_pembelian' => $totalPembelian,
                'tanggal_pembelian' => now(),
            ]);

            $barang->save();
        }

        

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }


   public function show($tanggal)
{
    $transaksis = Transaksi::with('barang')
        ->where('tanggal_pembelian', $tanggal)
        ->get();

    return view('transaksi.show', compact('transaksis', 'tanggal'));
}

    public function destroy($id)
    {
        Transaksi::destroy($id);
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
