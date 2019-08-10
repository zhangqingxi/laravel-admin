<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\AdminMenu;
use App\Models\Admin\AdminRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class RoleController
 * 角色
 * @author Qasim <15750783791@163.com>
 * @date 2019-05-19
 * @package App\Http\Controllers\Admin
 */
class RoleController extends BaseController
{


    /**
     * 主页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        return view('admin.role.list');

    }

    /**
     * 列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(Request $request)
    {

        try{


            $obj = AdminRole::with(['permissions', 'users'])->orderBy('id', 'desc');

            //角色名检索
            if($name = $request->input('name')){

                $obj = $obj->where('name', $name);

            }

            //角色状态检索
            if(($status = $request->input('status')) !== null){

                $obj = $obj->where('status', $status);

            }

            $roles = $obj->paginate(10);

        }catch (Exception $exception){

            return $this->json(0, '获取数据失败', [], $exception->getMessage());

        }

        return $this->json(1, '获取数据成功', $roles);

    }



    /**
     * 添加角色
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {

        return view('admin.role.add');

    }

    /**
     * 添加角色行为
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        if(empty($request->isJson())){

            return $this->json(0, '没有接收到json参数');

        }

        //参数验证
        try{

            $this->validate($request, [
                'name' => 'required|string',
                'remark' => 'required|string',
                'status' => 'required|in:0,1'
            ]);

            //接收字段
            $fields = json_decode($request->getContent(), true);

            //执行逻辑
            $adminRole = AdminRole::firstOrCreate($fields);

        }catch (ValidationException $exception){

            return $this->json(0, '数据验证不通过', [], array_values($exception->errors())[0][0]);

        }catch (Exception $exception){

            return $this->json(0, '数据添加失败', [], $exception->getMessage());

        }

        //返回数据
        if($adminRole->wasRecentlyCreated){

            return $this->json(1, '数据添加成功');

        }

        return $this->json(0, '数据添加失败');

    }


    /**
     * 编辑角色页面
     * @param AdminRole $adminRole
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(AdminRole $adminRole)
    {

        return view('admin.role.edit', compact('adminRole'));

    }

    /**
     * 编辑角色行为
     * @param Request $request
     * @param AdminRole $adminRole
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, AdminRole $adminRole)
    {

        if(empty($request->isJson())){

            return $this->json(0, '没有接收到json参数');

        }

        //参数验证
        try{

            $this->validate($request, [
                'name' => 'required|string',
                'remark' => 'required|string',
                'status' => 'required|in:0,1'
            ]);

            //接收字段
            $fields = json_decode($request->getContent(), true);

            $adminRole->update($fields);

        }catch (ValidationException $exception){

            return $this->json(0, '数据验证不通过', [], array_values($exception->errors())[0][0]);

        }catch (Exception $exception){

            return $this->json(0, '数据更新失败', [], $exception->getMessage());

        }

        return $this->json(1, '数据更新成功');

    }


    /**
     * 设置角色权限页面
     * @param AdminRole $adminRole
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function permission(AdminRole $adminRole)
    {

        //当前角色拥有的权限
        $adminRolePermissions = $adminRole->permissions;

        if(!empty($adminRolePermissions)){

            $adminRolePermissions = json_encode(array_column($adminRolePermissions->toArray(), 'id'));

        }

        return view('admin.role.permission', compact('adminRole', 'adminRolePermissions'));

    }

    /**
     * 设置角色权限行为
     * @param Request $request
     * @param AdminRole $adminRole
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePermission(Request $request, AdminRole $adminRole)
    {

        if(empty($request->isJson())){

            return $this->json(0, '没有接收到json参数');

        }

        //参数验证
        try{

            $this->validate($request, [
                'ids' => 'required|array',
            ]);

            //接收字段
            $fields = json_decode($request->getContent(), true);

            //获取要设置的菜单权限
            $adminMenuPermissions = AdminMenu::findMany($fields['ids']);

            //当前角色拥有的权限
            $adminRolePermissions = $adminRole->permissions;

            //角色已经拥有的权限与给定的权限进行差集对比  只插入新的权限
            $addAdminMenuPermissions = $adminMenuPermissions->diff($adminRolePermissions);

            foreach ($addAdminMenuPermissions as $addAdminMenuPermission) {

                $adminRole->grantPermission($addAdminMenuPermission);

            }

            //角色之前有的权限  现在没有给定过来  做删除操作
            $deleteAdminMenuPermissions = $adminRolePermissions->diff($adminMenuPermissions);

            foreach ($deleteAdminMenuPermissions as $deleteAdminMenuPermission) {

                $adminRole->deletePermission($deleteAdminMenuPermission);

            }

        }catch (ValidationException $exception){

            return $this->json(0, '数据验证不通过', [], array_values($exception->errors())[0][0]);

        }catch (Exception $exception){

            return $this->json(0, '数据更新失败', [], $exception->getMessage());

        }

        return $this->json(1, '数据更新成功');

    }


    /**
     * 更改角色状态
     * @param Request $request
     * @param AdminRole $adminRole
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Request $request, AdminRole $adminRole)
    {

        if(empty($request->isJson())){

            return $this->json(0, '没有接收到json参数');

        }

        //参数验证
        try{

            $this->validate($request, [
                'status' => 'required|in:0,1'
            ]);

            //接收字段
            $fields = json_decode($request->getContent(), true);

            //TODO 如果禁用角色 则删除该角色与用户的关联
            $adminRole->roleUsers()->delete();

            $adminRole->update($fields);

        }catch (ValidationException $exception){

            return $this->json(0, '数据验证不通过', [], array_values($exception->errors())[0][0]);

        }catch (Exception $exception){

            return $this->json(0, '数据更新失败', [], $exception->getMessage());

        }

        return $this->json(1, '数据更新成功');

    }


    /**
     * 批量删除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function statusAll(Request $request)
    {

        try {

            if(empty($request->isJson())){

                return $this->json(0, '没有接收到json参数');

            }

            $this->validate($request, [
                'ids' => 'required|array',
                'status' => 'required|in:0,1'
            ]);

            //接收字段
            $fields = json_decode($request->getContent(), true);

            $adminRoles = AdminRole::findMany($fields['ids']);

            foreach ($adminRoles as $adminRole){

                //TODO 如果禁用角色 则删除该角色与用户的关联
                $adminRole->roleUsers()->delete();

                $adminRole->update($fields);

            }

        }catch (ValidationException $exception){

            return $this->json(0, '数据验证不通过', [], array_values($exception->errors())[0][0]);

        }catch (Exception $exception){

            return $this->json(0, '数据批量删除失败', [],$exception->getMessage());

        }

        return $this->json(1, '数据批量删除成功');

    }

    /**
     * 软删除
     * @param AdminRole $adminRole
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(AdminRole $adminRole)
    {

        try{

            $adminRole->delete();

        }catch (Exception $exception){

            return $this->json(0, '数据删除失败', [], $exception->getMessage());

        }

        return $this->json(1, '数据删除成功');

    }

}
