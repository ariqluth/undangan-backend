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
        Schema::create('tamus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('undangan_id')->nullable();
            $table->foreign('undangan_id')->references('id')->on('undangans')->restrictOnDelete();
            $table->string('nama_tamu');
            $table->string('nomer_tamu');
            $table->string('alamat_tamu');
            $table->enum('status', ['datang', 'belum datang']);
            $table->enum('kategori', ['family', 'teman']);
            $table->string('kodeqr');
            $table->enum('tipe_undangan', ['digital', 'fisik']);
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
        Schema::dropIfExists('tamus');
    }
};
