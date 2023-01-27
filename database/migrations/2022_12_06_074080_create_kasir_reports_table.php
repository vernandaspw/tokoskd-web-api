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
        Schema::create('kasir_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kasir_id')->constrained('kasirs')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('kas_awal', 15, 2)->default(0);
            $table->decimal('total_uang_masuk', 15, 2)->default(0);
            $table->decimal('total_uang_keluar', 15, 2)->default(0);
            $table->decimal('kas_akhir', 15, 2)->default(0);
            $table->decimal('kas_tutup', 15, 2)->default(0);
            // selisih : kas akhir - kas tutup
            $table->decimal('selisih', 15, 2)->default(0);

            $table->bigInteger('jumlah_transaksi')->default(0);
            $table->decimal('uang_tunai', 15, 2)->default(0);
            $table->decimal('uang_tunonnai', 15, 2)->default(0);
            $table->decimal('tagihan_utang', 15, 2)->default(0);
            $table->decimal('omset', 15, 2)->default(0);
            $table->decimal('untung', 15, 2)->default(0);

            $table->foreignId('buka_oleh')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('tutup_oleh')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->timestamp('tutup_at')->nullable();
            $table->enum('status', ['open', 'pending', 'close']);
            // close akan memastikan bahwa kas diterima admin sesuai dengan kas tutup
            // jika ada selisih perbarui saldo saat ini

            // jika ada selisih -> update saldo+saldo pada kas col selisih
            // nantinya pada gaji dipotong dengan total selisih pada semua kas, setelah itu kurangi saldo selisih

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
        Schema::dropIfExists('kasir_reports');
    }
};
