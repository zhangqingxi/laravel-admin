<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\AdminRole;
use App\Models\Admin\AdminUser;
use Exception;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class UserController
 * 用户
 * @author Qasim <15750783791@163.com>
 * @date 2019-05-19
 * @package App\Http\Controllers\Admin
 */
class UserController extends BaseController
{


    /**
     * 主页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        return view('admin.user.list');

    }


    /**
     * 用户列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(Request $request)
    {

        try{

            $obj = AdminUser::with(['roles'])->orderBy('id', 'desc');

            //角色名检索
            if($username = $request->input('username')){

                $obj = $obj->where('username', $username);

            }

            //角色状态检索
            if(($status = $request->input('status')) !== null){

                $obj = $obj->where('status', $status);

            }

            $users = $obj->paginate(10);

            foreach ($users as &$user){

                /**
                 * @var AdminUser $user
                 */
                $user['is_admin'] = $user->isAdmin();

            }

            unset($user);

        }catch (Exception $exception){

            return $this->json(0, '获取数据失败', [], $exception->getMessage());

        }

        return $this->json(1, '获取数据成功', $users);

    }

    /**
     * 添加用户
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {

        return view('admin.user.add');

    }

    /**
     * 添加用户行为
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
                'username' => 'required|string|min:3|max:8',
                'nickname' => 'required|string|min:2|max:8',
                'password' => 'required|min:6|max:16|same:password_confirmation',
                'status' => 'required|in:0,1'
            ]);

            //接收字段
            $fields = json_decode($request->getContent(), true);

            unset($fields['password_confirmation']);

            $fields['password'] = bcrypt($fields['password']);

            //执行逻辑
            $adminUser = AdminUser::firstOrCreate($fields);

        }catch (ValidationException $exception){

            return $this->json(0, '数据验证不通过', [], array_values($exception->errors())[0][0]);

        }catch (Exception $exception){

            return $this->json(0, '数据添加失败', [], $exception->getMessage());

        }

        //返回数据
        if($adminUser->wasRecentlyCreated){

            return $this->json(1, '数据添加成功');

        }

        return $this->json(0, '数据添加失败');

    }


    /**
     * 编辑角色页面
     * @param AdminUser $adminUser
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(AdminUser $adminUser)
    {

        return view('admin.user.edit', compact('adminUser'));

    }

    /**
     * 修改密码页面
     * @param AdminUser $adminUser
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function password(AdminUser $adminUser)
    {

        return view('admin.user.password', compact('adminUser'));

    }


    /**
     * 编辑角色行为
     * @param Request $request
     * @param AdminUser $adminUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(Request $request, AdminUser $adminUser)
    {

        if(empty($request->isJson())){

            return $this->json(0, '没有接收到json参数');

        }

        //参数验证
        try{

            $this->validate($request, [
                'current_password' => 'required|string|min:6|max:16',
                'password' => 'required|string|min:6|max:16|same:password_confirmation',
            ]);

            //接收字段
            $fields = json_decode($request->getContent(), true);

            if($fields['current_password'] === $fields['password']){

                return $this->json(0, '当前密码与新密码相同');

            }

            $username = $adminUser->username;

            $password = $fields['current_password'];

            if(Auth::guard('admin')->attempt(compact('username', 'password')) === false){

                return $this->json(0, '当前密码验证失败');

            }

            $password = bcrypt($fields['password']);

            $adminUser->update(['password' => $password]);

            Auth::guard('admin')->logout();

        }catch (ValidationException $exception){

            return $this->json(0, '数据验证不通过', [], array_values($exception->errors())[0][0]);

        }catch (Exception $exception){

            return $this->json(0, '数据更新失败', [], $exception->getMessage());

        }

        return $this->json(1, '数据更新成功');

    }

    /**
     * 编辑角色行为
     * @param Request $request
     * @param AdminUser $adminUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, AdminUser $adminUser)
    {

        if(empty($request->isJson())){

            return $this->json(0, '没有接收到json参数');

        }

        if($adminUser->isAdmin()){

            return $this->json(0, '禁止操作');

        }

        //参数验证
        try{

            $this->validate($request, [
                'username' => 'required|string|min:3|max:8',
                'nickname' => 'required|string|min:2|max:8',
                'password' => 'min:6|max:16',
                'status' => 'required|in:0,1'
            ]);

            //接收字段
            $fields = json_decode($request->getContent(), true);

            if(isset($fields['password'])){

                $fields['password'] = bcrypt($fields['password']);

            }

            $adminUser->update($fields);

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
     * @param AdminUser $adminUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Request $request, AdminUser $adminUser)
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

            if($adminUser->isAdmin() && empty($fields['status'])){

                return $this->json(0, '禁止操作');

            }

            $adminUser->update($fields);

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

            $adminUsers = AdminUser::findMany($fields['ids']);

            foreach ($adminUsers as $adminUser){

                if($adminUser->isAdmin() && empty($fields['status'])){

                    continue;

                }

                $adminUser->update($fields);

            }

        }catch (ValidationException $exception){

            return $this->json(0, '数据验证不通过', [], array_values($exception->errors())[0][0]);

        }catch (Exception $exception){

            return $this->json(0, '数据批量更新失败', [],$exception->getMessage());

        }

        return $this->json(1, '数据批量更新成功');

    }


    /**
     * 软删除
     * @param AdminUser $adminUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(AdminUser $adminUser)
    {

        try{

            if($adminUser->isAdmin()){

                return $this->json(0, '禁止操作');

            }

            $adminUser->delete();

        }catch (Exception $exception){

            return $this->json(0, '数据删除失败', [], $exception->getMessage());

        }

        return $this->json(1, '数据删除成功');

    }


    /**
     * 设置用户角色页面
     * @param AdminUser $adminUser
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    /**
     * @param AdminUser $adminUser
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function role(AdminUser $adminUser)
    {

        //当前角色拥有的权限
        $adminUserRoles = $adminUser->roles;

        if(!empty($adminUserRoles)){

            $adminUserRoles = json_encode(array_column($adminUserRoles->toArray(), 'id'));

        }

        return view('admin.user.role', compact('adminUser', 'adminUserRoles'));

    }

    /**
     * 设置角色权限行为
     * @param Request $request
     * @param AdminUser $adminUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeRole(Request $request, AdminUser $adminUser)
    {

        if(empty($request->isJson())){

            return $this->json(0, '没有接收到json参数');

        }

        if($adminUser->isAdmin()){


            return $this->json(0, '禁止操作');

        }

        //参数验证
        try{

            $this->validate($request, [
                'role_ids' => 'required|string',
            ]);

            //接收字段
            $fields = json_decode($request->getContent(), true);

            //获取要设置的角色
            $adminRoles = AdminRole::findMany(explode(',', $fields['role_ids']));

            //当前角色拥有的权限
            $adminUserRoles = $adminUser->roles;

            // 对用户已经拥有的角色与给定的角色进行差集对比  只插入新的角色
            $addAdminUserRoles = $adminRoles->diff($adminUserRoles);

            foreach ($addAdminUserRoles as $addAdminUserRole) {

                $adminUser->assignRole($addAdminUserRole);

            }

            //对之前有的权限  现在没有提供过来  做删除操作
            $deleteAdminUserRoles = $adminUserRoles->diff($adminRoles);

            foreach ($deleteAdminUserRoles as $deleteAdminUserRole) {

                $adminUser->deleteRole($deleteAdminUserRole);

            }

        }catch (ValidationException $exception){

            return $this->json(0, '数据验证不通过', [], array_values($exception->errors())[0][0]);

        }catch (Exception $exception){

            return $this->json(0, '数据更新失败', [], $exception->getMessage());

        }

        return $this->json(1, '数据更新成功');

    }

}
