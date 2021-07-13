<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('status')->default('publish');
            $table->string('comment_status')->default('open');
            $table->string('slug')->nullable();
            $table->string('date')->default(date('F d, Y'));
            $table->string('modified')->nullable();
            $table->integer('parent')->default(0);
            $table->string('post_type')->default('post');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
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
