<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'id_barang',
        'jumlah',
        'harga_satuan',
        'diskon_saat_ini',
        'harga_setelah_diskon',
        'total_pembelian',
        'tanggal_pembelian',
    ];

    protected function casts():array
    {
        return [
            'tanggal_pembelian' => 'datetime'
        ];
    }

    public function barang()
    {
       return $this->belongsTo(Barang::class, 'id_barang');
    }
}
