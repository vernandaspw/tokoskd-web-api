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
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('no',20)->unique();
            $table->timestamp('priode_awal');
            $table->timestamp('priode_akhir');
            $table->decimal('tambah_gaji_pokok', 12,2)->default(0);
            $table->decimal('tambah_uang_makan', 12,2)->default(0);
            $table->decimal('tambah_uang_transportasi', 12,2)->default(0);
            $table->decimal('tambah_uang_lembur', 12,2)->default(0);
            $table->decimal('tambah_thr', 12,2)->default(0);
            $table->decimal('tambah_bonus', 12,2)->default(0);
            $table->decimal('total_penerimaan', 12,2)->default(0);
            $table->decimal('kurang_potongan_kehadiran', 12,2)->default(0);
            $table->decimal('kurang_potongan_pinjaman', 12,2)->default(0);
            $table->decimal('kurang_pph21', 12,2)->default(0);
            $table->decimal('kurang_potongan_lainnya', 12,2)->default(0);
            $table->decimal('total_potongan', 12,2)->default(0);
            $table->decimal('total_diterima', 12,2)->default(0);
            $table->longText('catatan')->nullable();
            $table->foreignId('metode_bayar')->nullable()->constrained('kas')->onUpdate('cascade')->onDelete('set null')->default(1);
            $table->enum('status', ['perlu dicek', 'perlu disetujui', 'perlu dicek ulang', 'proses pemberian', 'diterima', 'gagal']);
            $table->foreignId('diproses_oleh')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('diterima_oleh')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('gajis');
    }
};
