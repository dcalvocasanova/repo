<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias');
            $table->string('goverment_ID');//cedula
            $table->string('company');//nombre del negocio
            $table->string('telephone_1');
            $table->string('telephone_2');
            $table->boolean('status');//activo-inactivo
            $table->string('detailed_address');//direccion a lo Tico
            $table->string('GPS');
            $table->string('home');
            $table->string('url');//ubicacion de las fotos
            $table->timestamps();
            //FK de User
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('route_id')->unsigned();
            $table->foreign('route_id')->references('id')->on('catalogs')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('collector_id')->unsigned();
            $table->foreign('collector_id')->references('id')->on('collectors')->onDelete('cascade')->onUpdate('cascade');

            /* $table->integer('collector')->unsigned();//cobrador, lo jala de tabla cobradores
            $table->foreign('collector')->references('id')->on('collectors')->onDelete('cascade')->onUpdate('cascade'); */


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
