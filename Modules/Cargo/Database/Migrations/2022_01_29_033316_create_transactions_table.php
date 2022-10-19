<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('value');
            $table->integer('transaction_owner');
            $table->integer('captain_id')->unsigned()->nullable();
            $table->integer('client_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->integer('type');
            $table->integer('shipment_id')->unsigned()->nullable();
            $table->integer('mission_id')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('branch_owner_id')->unsigned()->nullable();
            $table->text('files')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
