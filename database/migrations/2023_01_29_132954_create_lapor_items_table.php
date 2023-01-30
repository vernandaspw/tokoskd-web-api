<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lapor_items', function (Blueprint $table) {
            $table->id();
            $table->enum('laporan', ['harga pokok baru', 'harga jual baru', 'harga merugi', 'akan expired', 'sudah expired', 'stok sedikit', 'stok habis']);
            $table->foreignId('riwayat_harga_id')->nullable()->constrained('riwayat_hargas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('produk_item')->nullable()->constrained('produk_items')->onUpdate('cascade')->onDelete('set null');
            $table->enum('status', ['pending', 'selesai', 'gagal']);
            $table->foreignId('dilapor_oleh')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('diproses_oleh')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lapor_items');
    }
};
