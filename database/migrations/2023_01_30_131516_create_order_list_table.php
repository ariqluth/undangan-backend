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
        Schema::create('order_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('verify_order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->restrictOnDelete();
            $table->foreign('verify_order_id')->references('id')->on('verify_order')->restrictOnDelete();
            $table->enum('type', ['selesai', 'proses', 'revisi']);
            $table->string('kode');
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
        Schema::dropIfExists('kbli');
    }
};
