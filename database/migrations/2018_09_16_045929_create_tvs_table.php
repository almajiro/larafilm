<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tvs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('original_name');
            $table->integer('episode_run_time');
            $table->string('homepage')->nullable();;
            $table->text('overview');
            $table->boolean('in_production');
            $table->string('origin_country');
            $table->string('original_language');
            $table->integer('popularity')->nullable();;
            $table->integer('vote_average')->nullable();;
            $table->integer('vote_count')->nullable();;
            $table->integer('status');
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
        Schema::dropIfExists('tvs');
    }
}
