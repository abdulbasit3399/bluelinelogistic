<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('name'); // translated
            $table->string('slug')->nullable();
            $table->text('description')->nullable(); // translated
            $table->string('image')->nullable();
            $table->boolean('active')->default(1); // toggle show\hide on frontend
            $table->timestamps();
            
            $table->foreign('parent_id')
               ->references('id')
               ->on('categories')
               ->onDelete('SET NULL');

            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
