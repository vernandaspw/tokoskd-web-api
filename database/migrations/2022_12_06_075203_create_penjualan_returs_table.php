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
        Schema::create('penjualan_returs', function (Blueprint $table) {
            $table->id();
            $table->char('no_penjualan_retur', 18)->unique();
            $table->timestamp('waktu')->default(now());
            $table->foreignId('penjualan_id')->nullable()->constrained('penjualan_pesanans')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggans')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onUpdate('cascade')->onDelete('set null');

            $table->decimal('total_harga_pokok', 15,2)->default(0);

            $table->decimal('total_harga_jual', 15,2)->default(0);

            $table->decimal('total_harga', 15,2)->default(0);

            $table->decimal('total_pembayaran_retur',15,2)->default(0);

            // omset = total_pembayaran - sisa belum bayar
            // omset = total pembayaran - pajak
            $table->decimal('omset_berkurang', 15,2)->default(0);

            // untung = sum(untungItem) + ongkir - potongan utang toko - pajak - ongkir_vendor  - sisa_belum_bayar
            $table->decimal('untung_berkurang', 15,2)->default(0);

            $table->longText('keterangan')->nullable();
            $table->enum('status', ['pending', 'success', 'failed']);
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('sales_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('penjualan_returs');
    }
};
