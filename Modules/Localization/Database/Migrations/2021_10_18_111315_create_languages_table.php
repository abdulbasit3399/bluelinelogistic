<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default('UNTITLED');
            $table->string('code')->default('en')->unique();
            $table->string('script')->nullable();
            $table->string('native')->nullable();
            $table->string('regional')->nullable();
            $table->string('dir')->nullable()->default('ltr');
            $table->string('image')->nullable();
            $table->boolean('is_default')->nullable()->default(0);
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('languages');
    }
}
