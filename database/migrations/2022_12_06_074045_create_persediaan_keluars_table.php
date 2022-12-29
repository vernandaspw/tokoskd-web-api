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
        Schema::create('persediaan_keluars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('produk_item_id')->constrained('produk_items')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status', ['penjualan', 'penyesuaian', 'retur pembelian', 'badstock']);
            $table->decimal('qty', 15,2)->default(0);
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
        Schema::dropIfExists('persediaan_keluars');
    }
};
