<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');

            $table->timestamp('start_at')->useCurrent();
            $table->float('amountRequested');//Monto inicial del crédito
            $table->float('amountRemaining');//Saldo

            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('interest_id')->unsigned();
            $table->foreign('interest_id')->references('id')->on('catalogs')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('period_id')->unsigned();
            $table->foreign('period_id')->references('id')->on('catalogs')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('creditTerm_id')->unsigned();
            $table->foreign('creditTerm_id')->references('id')->on('catalogs')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('loans');
    }
}
