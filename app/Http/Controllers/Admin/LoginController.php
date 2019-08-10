<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\UpdateAdminUserLoginInfo;
use App\Models\Admin\AdminMenu;
use App\Models\Admin\AdminUser;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends BaseController
{

    public function test()
    {
        dd(1234564);
    }
    /**
     * 登录页面
     */
    public function index()
    {

//        $adminUser = AdminUser::find(1);
//        $adminMenuPermission = AdminMenu::find(5);
//        $a = $adminUser->hasAdminMenuPermission($adminMenuPermission);
//        dd($a);
        return view('admin.login.index');

    }

    /**
     * 登录行为
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws ValidationException
     */
    public function login(Request $request)
    {

        //验证数据
        $this->validate($request, [
            'username' => 'required|min:3|max:8',
            'password' => 'required|max:16|min:6',
            'code' => 'required|size:4|check_code',
        ]);

        $username = $request->input('username');

        $password = $request->input('password');

        $status = 1;

        if(Auth::guard('admin')->attempt(compact('username', 'password', 'status'))){

            //异步任务通知  更新登录IP与登录时间
            $this->dispatch(new UpdateAdminUserLoginInfo(Auth::guard('admin')->id(), $request->getClientIp()));

            return redirect('/');

        }

        return back()->withErrors('账号密码不匹配或账户被禁用！');

    }

    /**
     * 注销
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {

        Auth::guard('admin')->logout();

        return redirect('login');

    }
}
