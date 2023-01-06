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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 30);
            $table->string('phone')->nullable();
            $table->string('telp')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('img', 80)->nullable();
            $table->string('provinsi', 20)->nullable();
            $table->string('kota', 20)->nullable();
            $table->longText('alamat')->nullable();
            $table->string('bank',20)->nullable();
            $table->string('norek',40)->nullable();
            $table->string('an',30)->nullable();
            $table->string('npwp',50)->nullable();
            $table->longText('keterangan')->nullable();
            $table->decimal('hutang_usaha', 12,2)->default(0);
            $table->decimal('piutang_usaha', 12,2)->default(0);
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
        Schema::dropIfExists('suppliers');
    }
};
