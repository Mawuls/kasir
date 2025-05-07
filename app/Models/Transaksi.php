<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'id_barang',
        'harga_asli',
        'nominal_diskon',
        'harga_diskon',
        'total_pembelian',
        'keuntungan',
        'tanggal_pembelian',
    ];

    protected function casts():array
    {
        return [
            'tanggal_pembelian' => 'date'
        ];
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
