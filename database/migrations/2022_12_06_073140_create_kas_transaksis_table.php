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
        Schema::create('kas_transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kas_t_jenis_id')->nullable()->constrained('kas_t_jenis')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('kas_t_kategori_id')->nullable()->constrained('kas_t_kategoris')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('kas_id')->constrained('kas')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('nominal', 16,2)->default(0);
            $table->longText('keterangan')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('asal_id')->nullable()->constrained('kas_transaksis')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('kas_transaksis');
    }
};
