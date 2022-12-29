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
        Schema::create('kas_t_kategoris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kas_t_jenis_id')->nullable()->constrained('kas_t_jenis')->onUpdate('cascade')->onDelete('set null');
            $table->string('nama', 40);
            $table->boolean('isaktif')->default(true);
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
        Schema::dropIfExists('kas_t_kategoris');
    }
};
