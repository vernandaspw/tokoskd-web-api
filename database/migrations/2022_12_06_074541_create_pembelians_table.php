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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembelian_pesanan_id')->nullable()->constrained('pembelian_pesanans')->onUpdate('cascade')->onDelete('set null');
            $table->char('no_pembelian', 18)->unique();
            $table->string('inv_supplier',30)->nullable();
            $table->timestamp('waktu')->default(now());
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onUpdate('cascade')->onDelete('set null');

            $table->decimal('total_harga_awal', 15,2)->default(0);
            $table->decimal('total_harga_akhir',12,2)->default(0);
            $table->decimal('biaya_lain',12,2)->default(0);
            $table->decimal('potongan',12,2)->default(0);
            $table->decimal('total_pembayaran',15,2)->default(0);
            $table->decimal('uang_muka', 15,2)->default(0);
            $table->decimal('sisa_belum_bayar', 15,2)->default(0);
            $table->boolean('islunas')->default(true);
            $table->longText('keterangan')->nullable();
            $table->enum('status', ['pending', 'success', 'failed']);
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
        Schema::dropIfExists('pembelians');
    }
};
