<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imdb_id')->nullable();
            $table->string('name');
            $table->string('known_for_department')->nullable();
            $table->date('birthday');
            $table->date('deathday')->nullable();
            $table->boolean('gender');
            $table->text('biography');
            $table->integer('popularity')->unsigned()->nullable();;
            $table->string('place_of_birth')->nullable();
            $table->string('homepage')->nullable();
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
        Schema::dropIfExists('persons');
    }
}
