<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageShipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_shipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('package_id')->unsigned();
            $table->integer('shipment_id')->unsigned();
            $table->text('description')->nullable();
            $table->double('weight')->nullable();
            $table->double('length')->nullable();
            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->double('qty')->nullable();
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
        Schema::dropIfExists('package_shipment');
    }
}
