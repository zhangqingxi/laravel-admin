<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\AdminSystemLog;
use Exception;
use Illuminate\Http\Request;

class SystemLogController extends BaseController
{

    /**
     * 系统日志首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        return view('admin.systemLog.list');

    }


    /**
     * 日志
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(Request $request)
    {

        try{

            if(!empty($date_range = $request->input('date_range'))){

                $dates = explode('~',  $date_range);

                $systemLogs = AdminSystemLog::orderBy('id', 'desc')->whereBetween('created_at', $dates)->paginate(10);

            }else{

                $systemLogs = AdminSystemLog::orderBy('id', 'desc')->paginate(10);

            }

        }catch (Exception $exception){

            return $this->json(0, '获取数据失败', [], $exception->getMessage());

        }

        return $this->json(1, '获取数据成功', $systemLogs);

    }

    /**
     * 清空表
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete()
    {

        try{

            AdminSystemLog::truncate();

        }catch (Exception $exception){

            return $this->json(0, '数据清空失败', [], $exception->getMessage());

        }

        return $this->json(1, '数据清空成功!');

    }

}
