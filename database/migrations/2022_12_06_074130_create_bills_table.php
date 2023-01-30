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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('no_bill', 10);

            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggans')->onUpdate('cascade')->onDelete('set null');

            $table->decimal('total_harga_pokok', 15,2)->default(0);

            $table->decimal('total_harga_jual', 15,2)->default(0);
            $table->decimal('potongan_diskon', 15,2)->default(0);
            $table->decimal('total_harga', 15,2)->default(0);

            $table->decimal('tagihan_utang',14,2)->default(0);
            $table->decimal('ongkir',12,2)->default(0);
            $table->decimal('pajak',12,2)->default(0);
            $table->decimal('potongan_utang_toko',15,2)->default(0);

            $table->decimal('total_pembayaran',15,2)->default(0);

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
        Schema::dropIfExists('bills');
    }
};
