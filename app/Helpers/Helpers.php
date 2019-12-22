<?php

if (!function_exists('prettyPrint')) {

    /**
     * 漂亮的数据打印
     * @param array $data
     * @return string
     */
    function prettyPrint(array $data = [])
    {

        return highlight_string("\n<?php\n" . var_export($data, true) . ";\n?>\n", true);

    }

}

if (!function_exists('getIp')) {
    /**
     * 获取客户端真实IP
     * @return string|null
     */
    function getIp()
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
                    if ((bool)filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {

                        return $ip;

                    }

                }

            }

        }

        return '0.0.0.0';

    }

}