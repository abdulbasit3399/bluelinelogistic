<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientShipmentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_shipment_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('from');
            $table->integer('to');
            $table->integer('created_by');
            $table->integer('shipment_id');
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
        Schema::dropIfExists('client_shipment_logs');
    }
}
