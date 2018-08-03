<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangeGlassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_glasses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user');
            $table->string('currency1');
            $table->string('currency2');
            $table->float('price');
            $table->float('amount');
            $table->float('total');
            $table->boolean('BUY');
            $table->datetime('timeOrderOpen');
            $table->datetime('timeOrderClose');
            $table->boolean('status');
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
        Schema::dropIfExists('exchange_glass');
    }
}
