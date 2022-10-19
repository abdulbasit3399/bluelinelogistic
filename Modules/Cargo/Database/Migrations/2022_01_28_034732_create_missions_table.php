<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->integer('status_id');
            $table->integer('type');
            $table->double('amount')->default('0');
            $table->integer('captain_id')->unsigned()->nullable();
            $table->string('address')->nullable();
            $table->integer('state')->nullable();
            $table->integer('area')->nullable();
            $table->unsignedInteger('order')->default('0');
            $table->integer('client_id')->unsigned()->nullable();
            $table->string('due_date')->nullable();
            $table->integer('to_branch_id')->nullable();
            $table->string('seg_img')->nullable();
            $table->string('otp')->nullable();
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
        Schema::dropIfExists('missions');
    }
}
