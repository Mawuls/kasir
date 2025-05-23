<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Support\Facades\Date;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('barang')->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('transaksi.create', compact('barangs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->id_barang);

        



        if ($barang->stock < $request->jumlah) {
            return back()->withErrors(['jumlah' => 'Stock barang tidak mencukupi']);
        }

        $hargaSatuan = $barang->harga;
        $diskonSaatIni = $barang->diskon_saat_ini;
        $hargaSetelahDiskon = $hargaSatuan - ($hargaSatuan * $diskonSaatIni / 100);
        $totalPembelian = $hargaSetelahDiskon * $request->jumlah;

        $barang->stock -= $request->jumlah;
        $barang->save();

        Transaksi::create([
            'id_barang' => $barang->id,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $hargaSatuan,
            'diskon_saat_ini' => $diskonSaatIni,
            'harga_setelah_diskon' => $hargaSetelahDiskon,
            'total_pembelian' => $totalPembelian,
            'tanggal_pembelian' => Date::now(),
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function show($id)
    {
        $transaksis = Transaksi::with('barang')->findOrFail($id);
        return view('transaksi.show', compact('transaksis'));
    }

    public function destroy($id)
    {
        Transaksi::destroy($id);
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
