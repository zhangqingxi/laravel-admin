@extends('admin.layout.main')

@section('content')

    <style>

        html{font-size:50px;-webkit-tap-highlight-color:transparent;height:100%;overflow:hidden}

        body{font-size:.28em;line-height:1;color:#333;height:100%;background:#16a085;overflow:hidden;}

        canvas{z-index:0;position:absolute;}

    </style>

    <form class="layui-form" method="POST" action="{{url('login')}}">

        @csrf

        <dl class="admin-login">

            <dt>

                <strong>后台管理系统</strong>

                <em>Management System</em>

            </dt>

            <dd class="item-input item-input-username">

                <label for="username"></label>

                <input lay-verify="required" autocomplete="off" id="username" name="username" type="text" placeholder="账号">

            </dd>

            <dd class="item-input item-input-password">

                <label for="password"></label>

                <input type="password" id="password" name="password" lay-verify="required" autocomplete="off" placeholder="密码">

            </dd>

            <dd class="item-input item-input-code">

                <label for="code"></label>

                <input id="code" type="text" lay-verify="required" name="code" autocomplete="off" placeholder="验证码">

                <img src="{{captcha_src('custom')}}" alt="" onclick="this.src='{{captcha_src("custom")}}'+Math.random()">

            </dd>

            @include('admin.layout.error')

            <dd class="submit-btn">

                <button lay-submit="" lay-filter="component-form">立即登陆</button>

            </dd>

        </dl>

    </form>

    <script>

        layui.extend({

            particleGround : '{/} {{asset('admin/common/jquery/jquery.particleGround')}}',

        }).use(['jquery', 'form', 'particleGround'], function () {

            let $ = layui.$, form = layui.form;

            //body 背景
            $('body').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });

        });

    </script>
@endsection
