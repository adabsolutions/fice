<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_markets', function (Blueprint $table) {
            $table->increments('id');
	$table->integer('cur1');
 $table->integer('cur2');
 $table->double('price');
 $table->double('volume');
 $table->double('change');
 $table->double('high');
 $table->double('low');
 $table->double('prev_price');
$table->double('prev_volume');






	
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
        Schema::dropIfExists('pr_markets');
    }
}
