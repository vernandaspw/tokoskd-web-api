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
        Schema::create('pembelian_returs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembelian_id')->nullable()->constrained('pembelians')->onUpdate('cascade')->onDelete('set null');
            $table->char('no_pembelian_retur', 18)->unique();
            $table->string('inv_supplier',30)->nullable();
            $table->timestamp('waktu')->default(now());
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onUpdate('cascade')->onDelete('set null');

            $table->decimal('total_harga_awal', 15,2)->default(0);
            $table->decimal('total_harga_akhir',15,2)->default(0);
            $table->decimal('total_harga_retur',15,2)->default(0);

            $table->longText('keterangan')->nullable();
            $table->enum('status', ['pending', 'success', 'failed']);
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
        Schema::dropIfExists('pembelian_returs');
    }
};
