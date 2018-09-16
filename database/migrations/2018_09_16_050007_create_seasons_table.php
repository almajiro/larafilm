<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tv_id')->unsigned();
            $table->string('name');
            $table->text('overview');
            $table->integer('season_number');
            $table->date('air_date');
            $table->timestamps();
        });

        Schema::table('seasons', function (Blueprint $table) {
            $table->foreign('tv_id')
                ->references('id')
                ->on('tvs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasons');
    }
}
