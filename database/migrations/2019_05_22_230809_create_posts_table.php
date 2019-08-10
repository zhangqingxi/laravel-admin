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
            $table->bigIncrements('id');
            $table->unsignedInteger('admin_user_id')->default(0)->comment('管理员ID');
            $table->string('ip', 30)->default('')->comment('管理员IP');
            $table->string('title', 100)->default('')->comment('标题');
            $table->string('description')->default('')->comment('简介');
            $table->text('content')->comment('内容');
            $table->string('image')->default('')->comment('图片');
            $table->unsignedTinyInteger('status')->default(0)->comment('文章状态 1已发布 0未发布');
            $table->unsignedTinyInteger('is_comment')->default(0)->comment('文章是否允许评论 1允许 0不允许');
            $table->unsignedTinyInteger('is_top')->default(0)->comment('是否允许置顶 1允许 0不允许');
            $table->unsignedInteger('hits')->default(0)->comment('浏览量');
            $table->softDeletes();
            $table->index(['title', 'status', 'is_comment', 'is_top']);
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
        Schema::dropIfExists('posts');
    }
}
