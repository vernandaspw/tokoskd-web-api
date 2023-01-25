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
        Schema::create('stok_opnames', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_item_id')->constrained('produk_items')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('stok_buku', 14,2)->default(0);
            $table->decimal('stok_fisik', 14,2)->default(0);
            $table->decimal('stok_selisih', 14,2)->default(0);
            $table->decimal('selisih_harga_produk', 14,2)->nullable();
            $table->decimal('selisih_total_harga_produk', 14,2)->nullable();
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
        Schema::dropIfExists('stok_opnames');
    }
};
