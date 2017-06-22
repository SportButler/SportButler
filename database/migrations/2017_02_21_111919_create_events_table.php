<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('field_id')->nullable();
            $table->datetime('start');
            $table->datetime('end');
            $table->integer('club_id')->nullable();
            $table->integer('sport_id')->nullable();
            $table->text('description')->nullable();;
            $table->integer('players')->nullable();
            $table->integer('currentplayers')->nullable();;
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
        Schema::dropIfExists('events');
    }
}
