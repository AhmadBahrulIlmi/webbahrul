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
        Schema::table('peramalan', function (Blueprint $table) {
        $table->string('label_periode')->nullable(); // misalnya 'April 2024'
        $table->float('alpha')->nullable();
        $table->float('mae')->nullable();
        $table->float('mape')->nullable();
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peramalan', function (Blueprint $table) {
            //
        });
    }
};