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
        Schema::create('produk_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produks')->onUpdate('cascade')->onDelete('cascade');
            // $table->string('nama', 100);
            $table->string('img', 80)->nullable();
            $table->string('barcode1', 100)->nullable();
            $table->string('barcode2', 100)->nullable();
            $table->string('barcode3', 100)->nullable();
            $table->string('barcode4', 100)->nullable();
            $table->string('barcode5', 100)->nullable();
            $table->string('barcode6', 100)->nullable();
            $table->boolean('satuan_dasar')->default(false);
            $table->foreignId('satuan_id')->constrained('satuans')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('konversi', 12,2)->default(1);
            $table->decimal('harga_pokok', 14,2)->default(0);
            $table->decimal('harga_jual',14,2)->default(0);
            $table->decimal('stok_minimum', 12,2)->default(0);
            $table->decimal('stok_beli', 14,2)->default(0);
            $table->decimal('stok_jual', 14,2)->default(0);
            $table->decimal('stok_buku', 14,2)->default(0);
            $table->decimal('stok_fisik', 14,2)->default(0);
            // $table->decimal('stok_opname', 14,2)->default(0);
            // $table->timestamp('opname_at')->nullable();
            $table->decimal('diskon_harga_jual',14,2)->default(0);
            $table->decimal('diskon_persen', 4,2)->default(0);
            $table->decimal('diskon', 4,2)->default(0);
            $table->date('diskon_start')->nullable();
            $table->date('diskon_end')->nullable();
            $table->time('jam_start')->nullable();
            $table->time('jam_end')->nullable();
            $table->boolean('isaktif')->default(true);
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
        Schema::dropIfExists('produk_items');
    }
};
