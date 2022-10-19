<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemeSettingContainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_setting_containers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->longText('data')->nullable();
            $table->string('place')->nullable();
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
        Schema::dropIfExists('theme_setting_containers');
    }
}
