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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->char('no_penjualan', 18)->unique();
            $table->timestamp('waktu')->default(now());
            $table->foreignId('penjualan_pesanan_id')->nullable()->constrained('penjualan_pesanans')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggans')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onUpdate('cascade')->onDelete('set null');

            $table->decimal('total_harga_pokok', 15,2)->default(0);

            $table->decimal('total_harga_jual', 15,2)->default(0);
            $table->decimal('potongan_diskon', 15,2)->default(0);
            $table->decimal('total_harga', 15,2)->default(0);

            $table->decimal('tagihan_utang',14,2)->default(0);
            $table->decimal('ongkir',12,2)->default(0);
            $table->decimal('pajak',12,2)->default(0);
            $table->decimal('potongan_utang_toko',15,2)->default(0);

            $table->decimal('total_pembayaran',15,2)->default(0);

            $table->decimal('diterima', 15,2)->default(0);
            // kembali = bayar - total_pembayaran
            $table->decimal('kembali', 15,2)->default(0);
            $table->decimal('kembali_kurang', 15,2)->default(0);

            $table->decimal('uang_muka', 15,2)->default(0);
            $table->decimal('sisa_belum_bayar', 15,2)->default(0);

            // diterima - kembali, uang_muka
            $table->decimal('pendapatan', 15,2)->default(0);
            $table->decimal('uang_tunai', 15,2)->default(0);
            $table->decimal('uang_nontunai', 15,2)->default(0);

            // omset = total_pembayaran - sisa belum bayar
            // omset = total pembayaran - pajak
            $table->decimal('omset', 15,2)->default(0);

            // untung = sum(untungItem) + ongkir - potongan utang toko - pajak - ongkir_vendor  - sisa_belum_bayar
            $table->decimal('untung', 15,2)->default(0);

            $table->boolean('islunas')->default(true);
            $table->longText('keterangan')->nullable();
            $table->enum('status', ['pending', 'success', 'failed']);
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('kasir_id')->nullable()->constrained('kasirs')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('penjualans');
    }
};
