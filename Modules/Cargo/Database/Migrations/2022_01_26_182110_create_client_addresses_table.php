<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_addresses', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->text('address')->nullable();
            $table->integer('country_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->integer('area_id')->unsigned()->nullable();
            $table->text('client_street_address_map')->nullable();
            $table->text('client_lat')->nullable();
            $table->text('client_lng')->nullable();
            $table->text('client_url')->nullable();
            $table->tinyInteger('is_default')->default(0);
            $table->tinyInteger('is_archived')->default(0);
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
        Schema::dropIfExists('client_addresses');
    }
}
