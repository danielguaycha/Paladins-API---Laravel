<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string("description", 255);
            $table->string('device_name', 100);
            $table->integer('icon_id');
            $table->integer('item_id');
            $table->integer('price')->default(0);
            $table->string('short_desc')->nullable();
            $table->integer('champion_id')->unsigned()->nullable();
            $table->string('icon_url', 150);
            $table->string('item_type', 250);
            $table->string('ret_msg')->nullable();
            $table->integer('talent_reward_level')->default(0);

            $table->foreign('champion_id')->references('id_hirex')->on('champions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
