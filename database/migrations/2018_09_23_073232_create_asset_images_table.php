<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_images', function (Blueprint $table) {
            $table->string('uuid', 36)->primary();
            $table->string('asset_uuid', 36);
            $table->integer('type')->unsigned();
            $table->timestamps();
        });

        Schema::table('asset_images', function (Blueprint $table) {
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
        Schema::dropIfExists('asset_images');
    }
}
