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
        Schema::create('peramalan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id');
            $table->date('periode'); // Bulan atau minggu per transaksi
            $table->integer('penjualan'); // Data aktual
            $table->double('s1')->nullable(); // S'
            $table->double('s2')->nullable(); // S''
            $table->double('at')->nullable(); // a_t
            $table->double('bt')->nullable(); // b_t
            $table->double('ft')->nullable(); // F_t
            $table->timestamps();

            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peramalan');
    }
};