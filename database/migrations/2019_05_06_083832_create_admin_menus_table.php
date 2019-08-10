<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('parent_id')->default(0)->comment('父菜单id');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态;1:显示,0:不显示');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->string('route', 40)->default('')->comment('应用路由');
            $table->string('name', 30)->unique()->default('')->comment('菜单名称');
            $table->string('icon', 20)->default('')->comment('菜单图标');
            $table->string('remark', 100)->default('')->comment('备注');
            $table->softDeletes()->comment('软删除');
            $table->index('sort');
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
        Schema::dropIfExists('admin_menus');
    }
}
