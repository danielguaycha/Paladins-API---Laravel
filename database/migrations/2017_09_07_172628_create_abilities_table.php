<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abilities', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description');
            $table->string('sumary', 255);
            $table->string('url', 100);
            $table->integer('champion_id')->unsigned();

            $table->foreign('champion_id')->references('id')->on('champions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //$table->dropForeign(['champion_id'])
        Schema::dropIfExists('abilities');
    }
}
