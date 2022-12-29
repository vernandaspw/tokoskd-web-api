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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('img', 80)->nullable();
            $table->enum('tipe', ['INV', 'nonINV', 'rakitan', 'jasa']);
            $table->foreignId('merek_id')->nullable()->constrained('mereks')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('catalog_id')->nullable()->constrained('catalogs')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('rak_id')->nullable()->constrained('raks')->onUpdate('cascade')->onDelete('set null');
            $table->boolean('isaktif')->default(true);
            $table->longText('keterangan')->nullable();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('produks');
    }
};
