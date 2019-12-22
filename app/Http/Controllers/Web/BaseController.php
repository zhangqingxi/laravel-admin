<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Response;

class BaseController extends Controller
{

    /**
     * 数据返回
     * @param int $status
     * @param string $message
     * @param array $data
     * @param string $exception_message
     * @return JsonResponse
     */
    protected function json(int $status = 1, string $message = '成功', $data = [], string $exception_message = '')
    {

        return Response::json(compact('status', 'message', 'data', 'exception_message'));

    }

}
