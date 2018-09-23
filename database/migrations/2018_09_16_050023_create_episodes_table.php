<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->string('uuid', 36)->primary();
            $table->string('season_uuid', 36);
            $table->string('title');
            $table->text('plot');
            $table->integer('episode')->unsigned();

            $table->date('aired');
            $table->integer('rating')->nullable()->default(0);
            $table->integer('votes')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::table('episodes', function (Blueprint $table) {
            $table->foreign('season_uuid')
                ->references('uuid')
                ->on('seasons')
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
        Schema::dropIfExists('episodes');
    }
}
