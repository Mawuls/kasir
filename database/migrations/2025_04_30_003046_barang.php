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
                Schema::create('barangs', function (Blueprint $table) {
                $table->id();
                $table->string('nama_barang');
                $table->integer('harga');
                $table->integer('diskon_saat_ini')->default(0); // diskon per item (bisa 0)
                $table->integer('stock');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
