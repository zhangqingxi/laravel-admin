<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=Edge,Chrome=1"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <title></title>
    {{--    李洋,zblog,自媒体,SEO优化,网站建设,李洋博客,新鲜科技,科技博客,独立博客,个人博客,原创博客,zblog主题,zblog模板,zblog仿站,zblog企业模板,zblog安装,zblog插件,zblogphp,zblog教程,个人博客网站,个人博客模板--}}
    {{--    李洋博客提供个人/企业网站建设_zblogPHP安装_制作zblog博客主题模板以及SEO排名优化的原创独立博客(网址:www.talklee.com)。--}}
    {{-- SEO设置 --}}
    <meta name="keywords" content=""/>

    <meta name="description" content=""/>

    <meta name="author" content="">

    <link href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/animate.css')}}" type="text/css" media="all"/>

    <link href="{{asset('/static/css/style.css')}}" type="text/css" media="all" rel="stylesheet"/>

    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon"/>

    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon"/>

    <script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>

    <script src="{{asset('js/swiper.min.js')}}"></script>

    <!--引入资源-->
    <link rel="stylesheet" href="{{asset('static/layui/layui/css/layui.css')}}" media="all">

    <script src="{{asset('static/layui/layui/layui.js')}}"></script>

    <!--[if lte IE 7]>
    <link href="//cdn.bootcss.com/font-awesome/3.2.1/css/font-awesome-ie7.css" rel="stylesheet">
    <![endif]-->

    <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

    {{--统计代码--}}
    <script src=""></script>

</head>

<body>

    <!--loading-->
{{--    @include('admin.layout.loader', ['autoload' =>   (isset($autoload) ? $autoload : 0)])--}}

    @yield('content')

</body>

</html>