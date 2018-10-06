<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_videos', function (Blueprint $table) {
            $table->string('uuid', 36)->primary();
            $table->string('asset_uuid', 36);
            $table->integer('duration')->unsigned();
            $table->integer('height')->unsigned();
            $table->integer('width')->unsigned();
            $table->string('aspect_ratio');
            $table->float('fps');
            $table->json('chapter');
            $table->string('model_uuid', 36)->nullable();
            $table->string('model_type')->nullable();
            $table->timestamps();
        });

        Schema::table('asset_videos', function (Blueprint $table) {
            $table->foreign('asset_uuid')
                ->references('uuid')
                ->on('assets')
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
        Schema::dropIfExists('asset_videos');
    }
}
