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
        Schema::create('pembelian_pesanans', function (Blueprint $table) {
            $table->id();
            $table->char('no_pesanan_pembelian', 18)->unique();
            $table->timestamp('waktu')->default(now());
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('pembayaran_id')->nullable()->constrained('kas')->onUpdate('cascade')->onDelete('set null');
            $table->decimal('sub_total', 15,2)->default(0);
            $table->decimal('tot_potongan',12,2)->default(0);
            $table->decimal('tot_pajak',12,2)->default(0);
            $table->decimal('biaya_lain',12,2)->default(0);
            $table->decimal('tot_pembayaran',15,2)->default(0);
            $table->decimal('uang_muka', 15,2)->default(0);
            $table->decimal('belum_bayar', 15,2)->default(0);
            $table->boolean('islunas')->default(true);
            $table->longText('keterangan')->nullable();
            $table->enum('status', ['pending', 'success', 'failed']);
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
        Schema::dropIfExists('pembelian_pesanans');
    }
};
