<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\AdminMenu;
use App\Models\Admin\AdminUser;
use Auth;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IndexController extends BaseController
{

    //后台首页
    public function index()
    {

        //获取后台所有菜单
        $adminMenus = AdminMenu::scopes(['parents', 'status', 'sort'])->with(['children' => function(HasMany $q){

            $q->scopes(['status', 'sort'])->select(['id', 'parent_id', 'name', 'route']);

        }])->get(['id','name','icon', 'route']);

        $adminUser = Auth::guard('admin')->user();

        return view('admin.index', compact('adminMenus', 'adminUser'));

    }

}
