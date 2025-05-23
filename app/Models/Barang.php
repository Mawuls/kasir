<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['nama_barang', 'harga', 'diskon_saat_ini', 'stock'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_barang');
    }
}
