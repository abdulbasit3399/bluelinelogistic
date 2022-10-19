<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('code');
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('type')->default(1);
            $table->string('name');
            $table->string('email');
            $table->string('responsible_name')->nullable();
            $table->string('responsible_mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('national_id')->nullable();
            $table->tinyInteger('is_archived')->default(0);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('branches');
    }
}
