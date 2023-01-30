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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nip',19)->unique();
            $table->string('nama', 30);
            $table->string('phone', 16)->unique();
            $table->string('email', 50)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',80);
            $table->string('code', 65)->nullable();
            $table->timestampTz('code_expired_at')->nullable();
            $table->timestampTz('code_resend_at')->nullable();
            $table->timestampTz('last_seen_at')->nullable();
            $table->enum('role', ['superadmin', 'admin', 'kepala toko', 'store manager', 'inventory', 'staff', 'sales', 'helpers', 'legal']);
            // superadmin   : semua akses
            // admin        : semua akses, membeli barang ke supplier
            // kepala toko  : bebas
            // store manager: semua kerjaan, rekrutmen, sdm, cr, purchasing.
            // inventory    : stok control, barang mau expired, stok opname, menyiapkan produk dietalase
            // staff        : kasir, kebersihan toko, menyiapkan produk dietalase
            // sales        : melakukan penjualan, bonus penjualan
            // helpers      : membantu semua hal secara teknis di toko
            // legal        : legalitas, laporan pajak, aktivitas dengan vendor

            $table->boolean('isaktif')->default(true);


            $table->timestamp('tgl_gabung')->nullable();
            $table->decimal('gaji_pokok',12,2)->nullable();
            $table->decimal('pinjaman', 12,2)->default(0);
            // $table->integer('jatah_cuti_bulan')->default(0);
            $table->integer('sisa_jatah_cuti_bulan')->default(0);

            $table->enum('jk', ['l', 'p'])->nullable();
            $table->string('npwp', 30)->nullable();
            $table->longText('alamat')->nullable();
            $table->string('bank', 40)->nullable();
            $table->string('norek', 40)->nullable();
            $table->string('an', 40)->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
