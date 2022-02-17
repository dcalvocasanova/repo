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
            $table->unsignedBigInteger('user_id');//lo trae de la tabla de users
            $table->string('alias');
            $table->string('goverment_ID');//cedula
            $table->string('company');//nombre del negocio
            $table->string('telephone_1');
            $table->string('telephone_2');
            $table->string('collector');//cobrador, lo jala de tabla cobradores
            $table->string('route');//lo jala de la tabla de rutas
            $table->boolean('status');//activo-inactivo
            $table->string('detailed_address');//direccion a lo Tico
            $table->string('GPS');
            $table->string('home');
            $table->string('url');//ubicacion de las fotos
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
        Schema::dropIfExists('clients');
    }
}
