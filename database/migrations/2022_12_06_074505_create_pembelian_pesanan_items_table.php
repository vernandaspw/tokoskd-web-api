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
        Schema::create('pembelian_pesanan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembelian_pesanan_id')->constrained('pembelian_pesanans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('produk_id')->nullable()->constrained('produks')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('produk_item_id')->nullable()->constrained('produk_items')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('satuan_id')->nullable()->constrained('satuans')->onUpdate('cascade')->onDelete('set null');
            $table->decimal('harga_awal',15,2)->default(0);
            $table->decimal('harga_akhir',15,2)->default(0);
            $table->decimal('qty_awal', 12,2)->default(0);
            $table->decimal('qty_tersedia', 12,2)->default(0);
            $table->decimal('total_harga_awal',15,2)->default(0);
            $table->decimal('total_harga_akhir',15,2)->default(0);
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
        Schema::dropIfExists('pembelian_pesanan_items');
    }
};
