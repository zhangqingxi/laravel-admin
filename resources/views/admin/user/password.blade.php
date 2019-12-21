@extends('admin.layout.main', ['autoload' => 1])

@section('content')

    <div class="layui-fluid" id="admin-users-password">

        <div class="layui-card">

            <div class="layui-card-body" pad15>

                <input type="hidden" id="id" value="{{$adminUser->id}}"/>

                <div class="layui-form">

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="current-password">当前密码</label>

                        <div class="layui-input-inline w-100">

                            <input type="text" id="current-password" value="" lay-verify="required" name="current_password" placeholder="请输入当前登录密码" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="password">新密码</label>

                        <div class="layui-input-inline w-100">

                            <input type="text" id="password" value="" lay-verify="required" name="password" placeholder="请输入新的用户密码" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="password-confirmation">确认密码</label>

                        <div class="layui-input-inline w-100">

                            <input type="text" id="password-confirmation" value="" lay-verify="required" name="password_confirmation" placeholder="请确认新的用户密码" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label"></label>

                        <div class="layui-input-inline w-100">

                            <button class="layui-btn" lay-submit lay-filter="admin-users-password-submit" id="admin-users-password-submit">确认修改</button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>

        layui.use(['form', 'common'], function(){

            const $ = layui.$,
                form = layui.form,
                common = layui.common,
                loader = layui.loader;

            let userId = $('#admin-users-password #id').val();

            let flag = false;
            //监听提交
            form.on('submit(admin-users-password-submit)', function(data){

                let field = data.field; //获取提交的字段

                let index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

                let url = "{{url('password')}}"+'/'+userId;

                if(flag) return false;

                flag = true;

                common.ajax(url, 'PUT', field, function (result) {

                    flag = false;

                    if(result.status === 1){

                        common.show('success', result.message, function () {

                            //前往登录
                            parent.window.location.href='/login';

                        });

                    }else{

                        common.show('info', result.message);

                    }

                },function(){

                    common.show('error', '服务器异常', function () {

                        flag = false;

                    });

                });

            });

        });

    </script>

@endsection




