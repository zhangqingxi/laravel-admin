<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <title>后台管理</title>

    <meta name="renderer" content="webkit">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <meta name="csrf-token" content="{{csrf_token()}}">

    <!--引入资源-->
    <link rel="stylesheet" href="{{asset('static/layui/layui/css/layui.css')}}" media="all">

    <link rel="stylesheet" href="{{asset('static/layui/style/admin.css')}}" media="all">

    <link rel="stylesheet" href="{{asset('static/common/style.css')}}" media="all"/>

    <script src="{{asset('static/layui/layui/layui.js')}}"></script>

    <!--初始化layui-->
    <script>
        //一般直接写在一个js文件中
        let ROOT_URL = "{{url('static').'/'}}";

        let ROOT_COMMON_URL = "{{url('static/common').'/'}}";
        //定义layuiadmin入口
        let ASSET_LAY = "{{asset('static/layui').'/'}}";

        layui.config({
            base: ASSET_LAY,//静态资源所在路径*-
        }).extend({ //设定模块别名
            index: 'lib/index', //主入口模块
            common: '{/}{{asset("static/common/common")}}',
        }).use(['index'], function () {
            layer.config({
                skin: 'layui-layer-molv'
            })
        });
    </script>
</head>

<body class="layui-layout-body">

    <!--loading-->
    @include('admin.layout.loader', ['autoload' =>   (isset($autoload) ? $autoload : 0)])

    @yield('content')

</body>

</html>