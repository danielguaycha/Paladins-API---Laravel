<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChampionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('champions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_hirex')->unsigned()->nullable();
            $table->string('name',100);
            $table->string('roles', 50);
            $table->string('title', 100);
            $table->text('lore');
            $table->string('card_url', 255);
            $table->string('icon_url', 150);
            $table->string('coins', 100);
            $table->integer('health');
            $table->integer('speed');
            $table->string('on_free_rotation', 50);
            $table->string('pantheon', 100);
            $table->string('pros', 100)->nullable();
            $table->string('type', 20)->nullable();
            $table->string('lastest_champion', 20);
            $table->string('ret_msg', 20)->nullable();

            $table->unique('id_hirex');

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
        Schema::dropIfExists('champions');
    }
}
