<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRecycleBin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_recycle_bin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('admin_user_id')->default(0)->comment('管理员ID');
            $table->string('table_name', 100)->default('')->comment('表名');
            $table->unsignedInteger('table_id')->default(0)->comment('表主键ID');
            $table->text('content')->comment('内容');
            $table->string('ip', 30)->default('')->comment('客户端ip');
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
        Schema::dropIfExists('admin_recycle_bin');
    }
}
