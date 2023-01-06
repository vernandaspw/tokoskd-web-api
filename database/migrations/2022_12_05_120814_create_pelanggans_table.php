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
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 30);
            $table->enum('jk', ['l','p']);
            $table->string('daerah', 30)->nullable();
            $table->longText('alamat')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->nullable();
            $table->string('img', 80)->nullable();
            $table->string('bank',20)->nullable();
            $table->string('norek',40)->nullable();
            $table->string('an',30)->nullable();
            $table->decimal('hutang_usaha', 12,2)->default(0);
            $table->decimal('piutang_usaha', 12,2)->default(0);
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
        Schema::dropIfExists('pelanggans');
    }
};
