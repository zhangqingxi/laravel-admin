<?php

namespace App\Http\Controllers\Web;

use App\Models\Admin\AdminMenu;
use App\Models\Admin\AdminUser;
use Auth;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IndexController extends BaseController
{

    //后台首页
    public function index()
    {

        return view('web.index');

    }

}
