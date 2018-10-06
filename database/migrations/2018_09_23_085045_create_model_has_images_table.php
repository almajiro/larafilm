<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelHasImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_images', function (Blueprint $table) {
            $table->string('image_uuid', 36);
            $table->string('model_uuid', 36);
            $table->string('model_type');
        });

        Schema::table('model_has_images', function (Blueprint $table) {
            $table->foreign('image_uuid')
                ->references('uuid')
                ->on('asset_images')
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
        Schema::dropIfExists('model_has_images');
    }
}
