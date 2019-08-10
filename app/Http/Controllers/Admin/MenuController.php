<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\AdminMenu;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MenuController extends BaseController
{

    //首页
    public function index()
    {

        return view('admin.menu.list');

    }


    /**
     * 菜单列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(Request $request)
    {

        //不分类 返回所有列表
        try{

            $adminMenus = AdminMenu::scopes(['sort'])->get(['id', 'parent_id', 'name', 'route', 'remark', 'status', 'sort']);

        }catch (Exception $exception){

            return $this->json(0, '获取数据失败', [], $exception->getMessage());

        }

        return $this->json(1, '获取数据成功', $adminMenus);

    }


    /**
     * 菜单列表  ===> 分类格式返回
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function classifyLists(Request $request)
    {

        try{

            //获取后台所有菜单
            $adminMenus = AdminMenu::scopes(['parents', 'sort'])->with('allChildren')->get(['id','name']);

        }catch (Exception $exception){

            return $this->json(0, '获取数据失败', [], $exception->getMessage());

        }

        return $this->json(1, '获取数据失败', $adminMenus);

    }

    /**
     * 添加菜单
     * @param AdminMenu $adminMenu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(AdminMenu $adminMenu)
    {

        return view('admin.menu.add', compact('adminMenu'));

    }

    /**
     * 添加菜单行为
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
                'name' => 'required|string|size:4'
            ]);

            //接收字段
            $fields = $request->only(['parent_id', 'name', 'sort', 'status', 'route', 'icon', 'remark']);

            //过滤为空 为null的字段
            $fields = array_filter($fields);

            //执行逻辑
            $adminMenu = AdminMenu::firstOrCreate($fields);

        }catch (ValidationException $exception){

            return $this->json(0, '数据验证不通过', [], array_values($exception->errors())[0][0]);

        }catch (Exception $exception){

            return $this->json(0, '数据添加失败', [], $exception->getMessage());

        }

        //返回数据
        if($adminMenu->wasRecentlyCreated){

            return $this->json(1, '数据添加成功');

        }

        return $this->json(0, '数据添加失败');

    }


    /**
     * 编辑菜单页面
     * @param AdminMenu $adminMenu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(AdminMenu $adminMenu)
    {

        return view('admin.menu.edit', compact('adminMenu'));

    }

    /**
     * 编辑菜单行为
     * @param Request $request
     * @param AdminMenu $adminMenu
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, AdminMenu $adminMenu)
    {

        if(empty($request->isJson())){

            return $this->json(0, '没有接收到json参数');

        }

        //参数验证
        try{

            $this->validate($request, [
                'name' => 'required|string|size:4'
            ]);

            //接收字段
            $fields = json_decode($request->getContent(), true);

            $adminMenu->update($fields);

        }catch (ValidationException $exception){

            return $this->json(0, '数据验证不通过', [], array_values($exception->errors())[0][0]);

        }catch (Exception $exception){

            return $this->json(0, '数据更新失败', [], $exception->getMessage());

        }

        return $this->json(1, '数据更新成功');

    }

    /**
     * 软删除
     * @param AdminMenu $adminMenu
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(AdminMenu $adminMenu)
    {

        //获取该菜单是否存在下级  有下级不可直接删除
        if($adminMenu->children->count() !== 0){

            return $this->json(0, '该菜单下还有子菜单，无法直接删除 ');

        }

        try{

            $adminMenu->delete();

        }catch (Exception $exception){

            return $this->json(0, '数据删除失败', [], $exception->getMessage());

        }

        return $this->json(1, '数据删除成功');

    }

}
