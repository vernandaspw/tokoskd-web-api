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
        Schema::create('riwayat_hargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('produk_item_id')->constrained('produk_items')->onUpdate('cascade')->onDelete('cascade');

            $table->foreignId('pembelian_id')->nullable()->constrained('pembelians')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('penjulan_id')->nullable()->constrained('penjualans')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('stok_transaksi_id')->nullable()->constrained('stok_transaksis')->onUpdate('cascade')->onDelete('set null');

            $table->decimal('harga_jual_awal', 13,2)->nullable();
            $table->decimal('harga_jual_akhir', 13,2)->nullable();
            $table->decimal('harga_beli_awal', 13,2)->nullable();
            $table->decimal('harga_beli_akhir', 13,2)->nullable();

            $table->enum('status', ['tidak diperbarui', 'perlu diperbarui', 'telah diperbarui'])->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('riwayat_hargas');
    }
};
