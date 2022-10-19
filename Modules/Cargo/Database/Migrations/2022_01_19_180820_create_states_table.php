<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('country_code')->nullable();
            $table->string('fips_code')->nullable();
            $table->string('iso2')->nullable();
            $table->decimal('latitude', 10,8)->nullable(); 
            $table->decimal('longitude', 11,8)->nullable(); 
            $table->tinyInteger('flag')->default(1);
            $table->string('wikiDataId')->nullable();
            $table->boolean('covered')->default(0);
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
        Schema::dropIfExists('states');
    }
}
