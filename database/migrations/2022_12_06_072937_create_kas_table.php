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
        Schema::create('kas', function (Blueprint $table) {
            $table->id();
            $table->integer('no')->nullable();
            $table->enum('tipe', ['tunai', 'tunai kasir', 'bank', 'ewallet']);
            $table->string('nama', 30);
            $table->decimal('saldo', 19, 2)->nullable();
            $table->decimal('saldo_selisih', 19, 2)->nullable();
            $table->string('bank', 30)->nullable();
            $table->string('norek', 50)->nullable();
            $table->string('an', 40)->nullable();
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
        Schema::dropIfExists('kas');
    }
};
