<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
                    Schema::create('transaksis', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_barang')->constrained('barangs')->onDelete('restrict');
                $table->integer('jumlah');
                $table->integer('harga_satuan');
                $table->integer('diskon_saat_ini')->default(0);
                $table->integer('harga_setelah_diskon');
                $table->integer('total_pembelian');
                $table->dateTime('tanggal_pembelian');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
