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
            $table->char('no_pembelian_pesanan', 18)->unique();
            $table->timestamp('waktu')->default(now());
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onUpdate('cascade')->onDelete('set null');

            $table->decimal('total_harga_awal', 15,2)->default(0);
            $table->decimal('total_harga_akhir', 15,2)->default(0);
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
        Schema::dropIfExists('pembelian_pesanans');
    }
};
