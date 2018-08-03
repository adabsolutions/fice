<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ce_trans', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('time');

            $table->string('wallet_from');
            $table->string('wallet_to');
            $table->string('currency_from');
            $table->string('currency_to');
            $table->boolean('type');
            $table->float('amount');
            $table->float('price');
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
        Schema::dropIfExists('ce_trans');
    }
}
