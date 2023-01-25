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
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko', 40);
            $table->string('img',80)->nullable();
            $table->string('provinsi', 30)->nullable();
            $table->string('daerah', 30)->nullable();
            $table->longText('alamat')->nullable();
            $table->string('telp', 16)->nullable();
            $table->string('npwp', 50)->nullable();
            $table->string('pajak', 4,2)->default(0);
            $table->boolean('absen_masuk_keluar')->default(false);
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
        Schema::dropIfExists('perusahaans');
    }
};
