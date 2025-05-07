<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;

class TransaksiController extends Controller
{
    public function index()
            {
            $transaksis = Transaksi::all();
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
                'harga_asli' => 'required|string',
                'nominal_diskon' => 'required|exists:barangs,id',
                'harga_diskon' => 'required|string',
                'total_pembelian' => 'required|string',
                'keuntungan' => 'required|string',
                'tanggal_pembelian' => 'required|date',
            ]);
        
            $barangs = Barang::find($request->id_barang);

            Transaksi::create([
                'id_barang' => $request->id_barang,
                'nama_barang' => $barangs->nama_barang,
                'harga' => $barangs->harga,
                'stock' => $barangs->stock,
                'harga_asli' => $request->harga_asli,
                'nominal_diskon' => $request->nominal_diskon,
                'diskon_saat_ini' => $request->diskon_saat_ini,
                'harga_diskon' => $request->harga_diskon,
                'total_pembelian' => $request->total_pembelian,
                'keuntungan' => $request->keuntungan,
                'tanggal_pembelian' => $request->tanggal_pembelian,
            ]);

           
        
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
        }
        
        
            public function edit($id)
            {
            $transaksis = Transaksi::findOrFail($id);
            return view('transaksi.edit', compact('transaksis'));
            }
        
            public function update(Request $request, $id)
            {
            $request->validate([
                'id_barang' => 'required|unique:transaksis,kode,'. $id,
                'harga_asli' => 'required',
                'nominal_diskon' => 'required',
                'harga_diskon' => 'required',
                'total_pembelian' => 'required',
                'keuntungan' => 'required',
                'tanggal_pembelian' => 'required|date',
            ]);
        
        
            $transaksis = Transaksi::findOrFail($id);
            $transaksis->update($request->all());
            return redirect()->route('transaksi.index')->with('success', 'Data Transaksi berhasil diperbarui');
            }
        
            public function destroy($id)
            {
             Transaksi::destroy($id);
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
            }
        
}
