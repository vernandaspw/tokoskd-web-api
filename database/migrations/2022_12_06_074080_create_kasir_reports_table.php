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
            $table->decimal('kas_akhir', 14,2)->default(0);
            $table->decimal('kas_tutup', 14,2)->default(0);
              // selisih : kas akhir - kas tutup
            $table->decimal('selisih', 14,2)->default(0);
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
        Schema::dropIfExists('kasir_reports');
    }
};
