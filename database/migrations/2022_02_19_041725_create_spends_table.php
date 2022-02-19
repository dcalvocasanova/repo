<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spends', function (Blueprint $table) {
            $table->increments('id');

            $table->float('spendAmount');//Monto de gasto
            $table->string('url');//ubicacion de los archivos de recibos

            $table->timestamps();

            $table->integer('collector_id')->unsigned();
            $table->foreign('collector_id')->references('id')->on('collectors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spends');
    }
}
