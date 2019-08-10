<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\AdminRecycleBin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RecycleBinController extends BaseController
{


    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.recycleBin.list');
    }

    public function lists(Request $request)
    {

        try{

            if(!empty($date_range = $request->input('date_range'))){

                $dates = explode('~',  $date_range);

                $adminRecycleBin = AdminRecycleBin::orderBy('id', 'desc')->whereBetween('created_at', $dates)->paginate(10);

            }else{

                $adminRecycleBin = AdminRecycleBin::orderBy('id', 'desc')->paginate(10);

            }

        }catch (Exception $exception){

            return $this->json(0, '数据获取失败', [], $exception->getMessage());

        }

        return $this->json(1, '数据获取成功', $adminRecycleBin);

    }


    /**
     * 恢复资源
     * @param AdminRecycleBin $adminRecycleBin
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(AdminRecycleBin $adminRecycleBin)
    {

        try{

            //删除回收站资源
            $adminRecycleBin->delete();

            //恢复资源
            $this->execDeleteOrRestoreOperation($adminRecycleBin, 1);

        }catch (Exception $exception){

            return $this->json(0, '数据还原失败', [], $exception->getMessage());

        }

        return $this->json(1, '数据还原成功');

    }


    /**
     * 资源删除成功
     * @param AdminRecycleBin $recycleBin
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(AdminRecycleBin $adminRecycleBin)
    {

        try{

            //删除回收站资源
            $adminRecycleBin->delete();

            //删除资源
            $this->execDeleteOrRestoreOperation($adminRecycleBin);

        }catch (Exception $exception){

            return $this->json(0, '数据删除失败', [], $exception->getMessage());

        }

        return $this->json(1, '数据删除成功');

    }


    /**
     * 资源批量还原
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function restoreAll(Request $request)
    {

        try{

            if(empty($request->isJson())){

                return $this->json(0, '没有接收到json参数');

            }

            $this->validate($request, [
                'ids' => 'required|array'
            ]);

            //接收字段
            $fields = json_decode($request->getContent(), true);

            $adminRecycleBinList = AdminRecycleBin::findMany($fields['ids']);

            foreach ($adminRecycleBinList as $value){

                //删除回收站资源
                $value->delete();

                //彻底删除资源
                $this->execDeleteOrRestoreOperation($value, 1);

            }

        }catch (Exception $exception){

            return $this->json(0, '数据批量还原失败', [],$exception->getMessage());

        }

        return $this->json(1, '数据批量还原成功');

    }


    /**
     * 批量删除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAll(Request $request)
    {

        try {

            if(empty($request->isJson())){

                return $this->json(0, '没有接收到json参数');

            }

            $this->validate($request, [
                'ids' => 'required|array'
            ]);

            //接收字段
            $fields = json_decode($request->getContent(), true);

            $adminRecycleBinList = AdminRecycleBin::findMany($fields['ids']);

            foreach ($adminRecycleBinList as $value){

                //删除回收站资源
                $value->delete();

                //彻底删除资源
                $this->execDeleteOrRestoreOperation($value);

            }

        }catch (ValidationException $exception){

            return $this->json(0, '数据验证不通过', [], array_values($exception->errors())[0][0]);

        }catch (Exception $exception){

            return $this->json(0, '数据批量删除失败', [],$exception->getMessage());

        }

        return $this->json(1, '数据批量删除成功');

    }

    /**
     * @param AdminRecycleBin $adminRecycleBin
     * @param int $type
     * @throws Exception
     */
    private function execDeleteOrRestoreOperation(AdminRecycleBin $adminRecycleBin, int $type = 0)
    {

        try{

            if($type === 1){

                $adminRecycleBin['table_name']::withTrashed()->findOrFail($adminRecycleBin['table_id'])->restore();

            }else{

                $adminRecycleBin['table_name']::withTrashed()->findOrFail($adminRecycleBin['table_id'])->forceDelete();

            }

        }catch (Exception $exception){

            throw new Exception($exception->getMessage());

        }

    }

}
