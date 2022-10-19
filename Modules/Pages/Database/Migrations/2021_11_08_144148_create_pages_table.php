<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id')->nullable(); // user id
            $table->unsignedBigInteger('template_id')->nullable();  // template id from config
            $table->unsignedBigInteger('parent_id')->nullable(); // page id (parent)

            // page content
            $table->text('title'); // translated
            $table->string('slug')->nullable();
            $table->longText('content')->nullable(); // translated
            $table->string('image')->nullable();

            // featured image
            $table->unsignedBigInteger('featurable_id')->nullable(); // media id or gallery id
            $table->string('featurable_type')->default('single'); // single = image, audio, video,  multi = gallery

            // page config
            $table->boolean('published')->default(0);
            $table->boolean('active')->default(1); // toggle show\hide on frontend
            $table->string('visibility', 20)->default('public'); // public, auth_user, private (for creator page)
            $table->timestamp('publish_on')->useCurrent()->nullable();

            // page seo
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
        Schema::dropIfExists('pages');
    }
}
