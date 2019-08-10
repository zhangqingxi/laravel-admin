@extends('admin.layout.main')

@section('content')

    <div id="LAY_app">

        <div class="layui-layout layui-layout-admin">

            {{--侧边菜单--}}
            @include('admin.layout.header')

            {{--侧边菜单--}}
            @include('admin.layout.menu')

            {{--页面标签--}}
            @include('admin.layout.tabs')

            <!-- 主体内容 -->
            <div class="layui-body" id="LAY_app_body">

                <div class="layadmin-tabsbody-item layui-show">

{{--                    <iframe src="{{url('article')}}" height="1200"  frameborder="0" class="layadmin-iframe"></iframe>--}}

                </div>

            </div>

            <!-- 辅助元素，一般用于移动设备下遮罩 -->
            <div class="layadmin-body-shade" layadmin-event="shade"></div>

        </div>

    </div>

@endsection


