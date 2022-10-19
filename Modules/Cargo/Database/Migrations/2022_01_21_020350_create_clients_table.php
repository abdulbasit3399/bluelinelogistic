<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('code');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->string('responsible_name')->nullable();
            $table->string('responsible_mobile')->nullable();
            $table->string('follow_up_name')->nullable();
            $table->string('follow_up_mobile')->nullable();
            $table->string('how_know_us')->nullable();
            $table->string('national_id')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('is_archived')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->double('pickup_cost')->default(0);
            $table->double('supply_cost')->default(0);
            $table->double('def_mile_cost')->default(0);
            $table->double('def_shipping_cost')->default(0);
            $table->double('def_tax')->default(0);
            $table->double('def_insurance')->default(0);
            $table->double('def_return_mile_cost')->default(0);
            $table->double('def_return_cost')->default(0);
            $table->double('def_shipping_cost_gram')->default(0);
            $table->double('def_mile_cost_gram')->default(0);
            $table->double('def_tax_gram')->default(0);
            $table->double('def_insurance_gram')->default(0);
            $table->double('def_return_cost_gram')->default(0);
            $table->double('def_return_mile_cost_gram')->default(0);
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
        Schema::dropIfExists('clients');
    }
}
