<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->longText('data')->nullable();
            $table->string('section')->nullable();
            $table->string('place')->nullable();
            $table->unsignedBigInteger('widget_id')->nullable();
            $table->unsignedBigInteger('container_id')->nullable();
            $table->string('theme')->nullable();
            $table->integer('sort')->default(0);
            $table->timestamps();

            $table->index('place');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_settings');
    }
}
