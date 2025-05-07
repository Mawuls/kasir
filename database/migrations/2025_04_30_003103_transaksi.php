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
            $table->foreignId('id_barang')->constrained('barangs')->onDelete('cascade');
            $table->string('harga_asli');
            $table->foreignId('nominal_diskon')->constrained('barangs')->onDelete('cascade');
            $table->string('harga_diskon');
            $table->string('total_pembelian');
            $table->string('keuntungan');
            $table->date('tanggal_pembelian');
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
