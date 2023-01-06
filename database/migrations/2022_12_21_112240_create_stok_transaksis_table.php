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
        Schema::create('stok_transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('produk_item_id')->constrained('produk_items')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('stok_jenis_id')->constrained('stok_jenis')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('stok_kategori_id')->constrained('stok_kategoris')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah')->default(0);
            $table->decimal('harga_jual_awal', 13,2)->nullable();
            $table->decimal('harga_jual_akhir', 13,2)->nullable();

            $table->decimal('harga_beli_awal', 13,2)->nullable();
            $table->decimal('harga_beli_akhir', 13,2)->nullable();
            $table->decimal('harga_beli_total', 13,2)->nullable();
            $table->longText('catatan')->nullable();
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
        Schema::dropIfExists('stok_transaksis');
    }
};
