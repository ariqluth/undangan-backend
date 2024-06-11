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
        Schema::create('undangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('order_list_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->restrictOnDelete();
            $table->foreign('order_list_id')->references('id')->on('order_lists')->restrictOnDelete();
            $table->string('nama_pengantin_pria');
            $table->string('nama_pengantin_wanita');
            $table->string('tanggal_pernikahan');
            $table->string('lokasi_pernikahan');
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
        Schema::dropIfExists('jenis_legalitas');
    }
};
