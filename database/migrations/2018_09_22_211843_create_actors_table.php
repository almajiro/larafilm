<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actors', function (Blueprint $table) {
            $table->string('uuid', 36)->primary();
            $table->string('person_uuid', 36);
            $table->string('role')->unique();
            $table->timestamps();
        });

        Schema::table('actors', function (Blueprint $table) {
            $table->foreign('person_uuid')
                ->references('uuid')
                ->on('persons')
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
        Schema::dropIfExists('actors');
    }
}
