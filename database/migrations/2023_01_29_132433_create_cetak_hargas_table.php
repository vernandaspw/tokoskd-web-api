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
        Schema::create('cetak_hargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('riwayat_harga_id')->nullable()->constrained('riwayat_hargas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produk_items')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('produk_item')->nullable()->constrained('produk_items')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('cetak_hargas');
    }
};
