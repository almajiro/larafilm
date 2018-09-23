<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelHasGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_genres', function (Blueprint $table) {
            $table->string('genre_uuid', 36);
            $table->string('model_uuid', 36);
            $table->string('model_type');
        });

        Schema::table('model_has_genres', function (Blueprint $table) {
            $table->foreign('genre_uuid')
                ->references('uuid')
                ->on('genres')
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
        Schema::dropIfExists('model_has_genres');
    }
}
