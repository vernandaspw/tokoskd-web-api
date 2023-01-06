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
        Schema::create('hutangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('jenis', ['tambah', 'kurang']);
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('kas_transaksi_id')->nullable()->constrained('kas_transaksis')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('penjualan_id')->nullable()->constrained('penjualans')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('pembelian_id')->nullable()->constrained('pembelians')->onUpdate('cascade')->onDelete('set null');
            $table->decimal('jumlah', 12,2)->default(0);
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('hutangs');
    }
};
