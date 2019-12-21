<?php
/**
 * ******************
 *    Author:Qasim
 *    后台路由
 * *******************
 */

Route::group(['namespace' => 'Admin'], function () {

    //登录页面
    Route::get('login', 'LoginController@index')->name('login');

    //登录行为
    Route::post('login', 'LoginController@login');

    //登出行为
    Route::get('logout', 'LoginController@logout');

    //修改密码
    Route::get('password/{adminUser}', 'UserController@password');

    //修改密码
    Route::put('password/{adminUser}', 'UserController@updatePassword');

    //权限认证
    Route::group(['middleware' => 'auth:admin'], function (){

        //首页
        Route::get('/', 'IndexController@index');

        //菜单管理
        Route::group(['prefix' => 'menus', 'middleware' => 'can:menus'], function (){

            //菜单首页
            Route::get('/', 'MenuController@index');

            //所有菜单列表
            Route::get('list', 'MenuController@lists')->middleware('can:menus/list');

            //菜单分类列表
            Route::get('classify', 'MenuController@classifyLists')->middleware('can:menus/list');

            //添加菜单页面
            Route::get('add', 'MenuController@add')->middleware('can:menus/add');

            //添加子菜单页面
            Route::get('add/{adminMenu}', 'MenuController@add')->middleware('can:menus/add');

            //添加菜单行为
            Route::post('add', 'MenuController@store')->middleware('can:menus/add');

            //编辑菜单页面
            Route::get('edit/{adminMenu}', 'MenuController@edit')->middleware('can:menus/edit');

            //编辑菜单行为
            Route::put('edit/{adminMenu}', 'MenuController@update')->middleware('can:menus/edit');

            //删除菜单行为
            Route::delete('delete/{adminMenu}', 'MenuController@delete')->middleware('can:menus/delete');

        });

        //回收站
        Route::group(['prefix' => 'recycleBin', 'middleware' => 'can:recycleBin'], function (){

            //回收站首页
            Route::get('/', "RecycleBinController@index");

            //回收站资源列表
            Route::get('list', 'RecycleBinController@lists')->middleware('can:recycleBin/list');

            //回收站资源恢复
            Route::delete('restore/{adminRecycleBin}', 'RecycleBinController@restore')->middleware('can:recycleBin/delete');

            //回收站资源删除
            Route::delete('delete/{adminRecycleBin}', 'RecycleBinController@delete')->middleware('can:recycleBin/delete');

            //回收站资源批量恢复
            Route::delete('restoreAll', 'RecycleBinController@restoreAll')->middleware('can:recycleBin/delete');

            //回收站资源批量删除
            Route::delete('deleteAll', 'RecycleBinController@deleteAll')->middleware('can:recycleBin/delete');

        });

        //系统日志
        Route::group(['prefix' => 'systemLogs', 'middleware' => 'can:systemLogs'], function (){

            //系统日志首页
            Route::get('/', "SystemLogController@index");

            //所有系统日志列表
            Route::get('list', 'SystemLogController@lists')->middleware('can:systemLogs/list');

            //清空系统日志行为
            Route::delete('delete', 'SystemLogController@delete')->middleware('can:systemLogs/clear');

        });

        //用户
        Route::group(['prefix' => 'users', 'middleware' => 'can:users'], function (){

            //用户首页
            Route::get('/', 'UserController@index');

            //用户列表
            Route::get('list', 'UserController@lists')->middleware('can:users/list');

            //添加用户
            Route::get('add', 'UserController@add')->middleware('can:users/add');

            //添加用户行为
            Route::post('add', 'UserController@store')->middleware('can:users/add');

            //编辑用户
            Route::get('edit/{adminUser}', 'UserController@edit')->middleware('can:users/edit');

            //编辑用户行为
            Route::put('edit/{adminUser}', 'UserController@update')->middleware('can:users/edit');

            //设置用户状态行为
            Route::put('status/{adminUser}', 'UserController@status')->middleware('can:users/edit');

            //批量设置用户状态行为
            Route::put('statusAll', 'UserController@statusAll')->middleware('can:users/edit');

            //删除用户行为
            Route::delete('delete/{adminUser}', 'UserController@delete')->middleware('can:users/delete');

            //设置用户角色
            Route::get('role/{adminUser}', 'UserController@role')->middleware('can:users/role');

            //设置用户角色行为
            Route::post('role/{adminUser}', 'UserController@storeRole')->middleware('can:users/role');

        });

        //角色
        Route::group(['prefix' => 'roles', 'middleware' => 'can:roles'], function (){

            //用户首页
            Route::get('/', 'RoleController@index');

            //用户列表
            Route::get('list', 'RoleController@lists')->middleware('can:roles/list');

            //添加角色
            Route::get('add', 'RoleController@add')->middleware('can:roles/add');

            //添加角色行为
            Route::post('add', 'RoleController@store')->middleware('can:roles/add');

            //编辑角色
            Route::get('edit/{adminRole}', 'RoleController@edit')->middleware('can:roles/edit');

            //编辑角色行为
            Route::put('edit/{adminRole}', 'RoleController@update')->middleware('can:roles/edit');

            //设置角色权限
            Route::get('permission/{adminRole}', 'RoleController@permission')->middleware('can:roles/permission');

            //设置角色权限行为
            Route::post('permission/{adminRole}', 'RoleController@storePermission')->middleware('can:roles/permission');

            //设置角色状态行为
            Route::put('status/{adminRole}', 'RoleController@status')->middleware('can:roles/edit');

            //批量设置角色状态行为
            Route::put('statusAll', 'RoleController@statusAll')->middleware('can:roles/edit');

            //删除角色行为
            Route::delete('delete/{adminRole}', 'RoleController@delete')->middleware('can:roles/delete');

        });

        //文章
        Route::group(['prefix' => 'posts', 'middleware' => 'can:posts'], function (){

            //文章首页
            Route::get('/', 'PostController@index');

            Route::get('list', 'PostController@lists')->middleware('can:posts/list');

            //添加文章页
            Route::get('add', 'PostController@add')->middleware('can:posts/add');

            //添加文章逻辑
            Route::post('add', 'PostController@store')->middleware('can:posts/add');

            //图片上传
            Route::post('upload', 'PostController@upload')->middleware('can:posts/add');

        });

    });

});