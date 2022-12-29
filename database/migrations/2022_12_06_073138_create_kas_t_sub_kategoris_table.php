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
        Schema::create('kas_t_sub_kategoris', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['masuk', 'keluar']);
            $table->foreignId('kas_t_kategoris_id')->nullable()->constrained('kas_t_kategoris')->onUpdate('cascade')->onDelete('set null');
            $table->string('nama', 40);
            $table->boolean('ispiutang')->nullable();
            $table->boolean('ishutang')->nullable();
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
        Schema::dropIfExists('kas_t_sub_kategoris');
    }
};
