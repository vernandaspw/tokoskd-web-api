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
        Schema::create('kehadiran_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kehadiran_id')->constrained('kehadirans')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('masuk')->nullable();
            $table->timestamp('keluar')->nullable();
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
        Schema::dropIfExists('kehadiran_items');
    }
};
