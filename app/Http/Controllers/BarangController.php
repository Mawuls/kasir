<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'harga' => 'required|integer|min:0',
            'diskon_saat_ini' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'harga' => 'required|integer|min:0',
            'diskon_saat_ini' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
       
    $barang = Barang::findOrFail($id);

    // Check if any transaksi exists that references this barang
    if ($barang->transaksis()->exists()) {
        return back()->with('error', 'Tidak bisa menghapus barang karena masih memiliki transaksi.');
    }

    $barang->delete();

    return back()->with('success', 'Barang berhasil dihapus.');


    }
}
