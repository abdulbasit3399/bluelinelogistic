<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id')->nullable(); // user id

            // post content
            $table->text('title'); // translated
            $table->string('slug')->nullable();
            $table->longText('content')->nullable(); // translated
            $table->string('image')->nullable();

            // featured image
            $table->unsignedBigInteger('featurable_id')->nullable(); // media id or gallery id
            $table->string('featurable_type')->default('single'); // single = image, audio, video,  multi = gallery

            // post config
            $table->boolean('published')->default(0);
            $table->boolean('active')->default(1); // toggle show\hide on frontend
            $table->string('visibility', 20)->default('public'); // public, auth_user, private (for creator post)
            $table->timestamp('publish_on')->useCurrent()->nullable();

            // post seo
            $table->text('seo_title')->nullable(); // translated
            $table->text('seo_description')->nullable(); // translated

            // date
            $table->timestamps();

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
        Schema::dropIfExists('posts');
    }
}
