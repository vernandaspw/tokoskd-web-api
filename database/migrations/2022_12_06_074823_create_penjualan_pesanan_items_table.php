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
        Schema::create('penjualan_pesanan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjualan_pesanan_id')->constrained('penjualan_pesanans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('produk_id')->nullable()->constrained('produks')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('merek_id')->nullable()->constrained('mereks')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('catalog_id')->nullable()->constrained('catalogs')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('rak_id')->nullable()->constrained('raks')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('produk_item_id')->nullable()->constrained('produk_items')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('satuan_id')->nullable()->constrained('satuans')->onUpdate('cascade')->onDelete('set null');
            $table->decimal('harga_modal',15,2)->default(0);
            $table->decimal('harga_jual',15,2)->default(0);
            $table->decimal('qty', 12,2)->default(0);
            // total harga_modal = harga_modal * qty
            $table->decimal('total_harga_modal',15,2)->default(0);
            // total harga jual =  harga jual * qty
            $table->decimal('total_harga_jual',15,2)->default(0);
            $table->decimal('diskon_persen', 12,2)->default(0);
            // potongan diskon = diskon * qty
            $table->decimal('potongan_diskon', 12,2)->default(0);
            // total = total_harga_jual - potongan diskon
            $table->decimal('total_harga',15,2)->default(0);
            // untung = total_harga - total_harga_jual
            $table->decimal('untung',15,2)->default(0);
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
        Schema::dropIfExists('penjualan_pesanan_items');
    }
};
