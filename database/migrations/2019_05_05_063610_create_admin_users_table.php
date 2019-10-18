<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username','50')->unique()->default('')->comment('用户名');
            $table->string('password','100')->default('')->comment('用户密码');
            $table->string('nickname','100')->default('')->comment('用户昵称');
            $table->string('last_login_ip', 15)->default('')->comment('最后登录IP');
            $table->unsignedInteger('login_times')->default(0)->comment('登录次数');
            $table->unsignedTinyInteger('status')->default(1)->comment('用户状态 1正常 0禁用');
            $table->softDeletes()->comment('软删除');
            $table->index(['nickname', 'status']);
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
        Schema::dropIfExists('admin_users');
    }
}
