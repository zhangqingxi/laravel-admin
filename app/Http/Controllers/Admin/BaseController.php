<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;
use Illuminate\Http\JsonResponse;
use Response;

class BaseController extends CommonController
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


    /**
     * 获取客户端真实IP
     * @return string|null
     */
    public function getIp()
    {

        $keys = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        ];

        foreach ($keys as $key) {

            if (array_key_exists($key, $_SERVER)) {

                foreach (explode(',', $_SERVER[$key]) as $ip) {

                    $ip = trim($ip);

                    //会过滤掉保留地址和私有地址段的IP，例如 127.0.0.1会被过滤
                    //也可以修改成正则验证IP
                    if ((bool)filter_var($ip, FILTER_VALIDATE_IP,FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE |FILTER_FLAG_NO_RES_RANGE)) {

                        return $ip;

                    }

                }

            }

        }

        return 'Unknown';

    }

}
