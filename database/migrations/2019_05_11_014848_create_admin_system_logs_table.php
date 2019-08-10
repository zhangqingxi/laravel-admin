<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminSystemLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_system_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('admin_user_id')->default(0)->comment('管理员ID');
            $table->string('route', 50)->default('')->comment('执行路由');
            $table->string('method', 10)->default('')->comment('执行方法');
            $table->string('ip', 30)->default('')->comment('客户端ip');
            $table->string('table_name', 100)->default('')->comment('表名');
            $table->unsignedInteger('table_id')->unsigned()->comment('表ID');
            $table->string('title', 100)->default('')->comment('标题');
            $table->text('content')->comment('内容');
            $table->index('created_at');
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
        Schema::dropIfExists('admin_system_logs');
    }
}
