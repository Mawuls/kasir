<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'nama_barang',
        'harga',
        'stock',
        'diskon_saat_ini'
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_barang');
    }
}
