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
      'nama_barang' => 'required',
      'harga' => 'required',
      'stock' => 'required',
      'diskon_saat_ini'=>'required'
    ]);


    Barang::create($request->all());
    return redirect()->route('barang.index')->with('success', 'barang berhasil ditambahkan');
  }


  public function edit($id)
  {
    $barangs = Barang::findOrFail($id);
    return view('barang.edit', compact('barangs'));
  }


  public function update(Request $request, $id)
  {
    $request->validate([
      'nama_barang' => 'required',
      'harga' => 'required',
      'stock' => 'required',
      'diskon_saat_ini'=>'required'
    ]);


    $barangs = Barang::findOrFail($id);
    $barangs->update($request->all());
    return redirect()->route('barang.index')->with('success', 'Data berhasil diperbarui');
  }


 public function destroy($id)
  {
    Barang::destroy($id);
    return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
  }

}