@extends('admin.layout.main', ['autoload' => 1])

@section('content')

    <div class="layui-fluid" id="admin-users-add">

        <div class="layui-card">

            <div class="layui-card-body" pad15>

                <div class="layui-form">

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="username">用户名称</label>

                        <div class="layui-input-block">

                            <input type="text" id="username" lay-verify="required" name="username" placeholder="请输入用户名称" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="nickname">用户昵称</label>

                        <div class="layui-input-block">

                            <input type="text" id="nickname" lay-verify="required" name="nickname" placeholder="请输入用户昵称" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="password">用户密码</label>

                        <div class="layui-input-block">

                            <input type="password" id="password" lay-verify="required" name="password" placeholder="请输入用户密码" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="password-confirmation">确认密码</label>

                        <div class="layui-input-block">

                            <input type="password" id="password-confirmation" lay-verify="required" name="password_confirmation" placeholder="请确认用户密码" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="status">用户状态</label>

                        <div class="layui-input-block">

                            <input type="checkbox" id="status" lay-filter="status" name="status" value="1" lay-skin="switch" lay-text="启用|禁用">

                        </div>

                    </div>

                    <div class="layui-form-item layui-hide">

                        <button class="layui-btn" lay-submit lay-filter="admin-users-add-submit" id="admin-users-add-submit">立即提交</button>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>

        layui.use(['form', 'common'], function(){

            const $ = layui.$,
                form = layui.form,
                common = layui.common;

            let flag = false;
            //监听提交
            form.on('submit(admin-users-add-submit)', function(data){

                let field = data.field; //获取提交的字段

                let index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

                let url = "{{url('users/add')}}";

                if(flag) return false;

                flag = true;

                field.status = field.status ? 1 : 0;

                if(field.password !== field.password_confirmation){

                    common.show('warning', '两次输入的密码不匹配');

                    return;

                }

                common.ajax(url, 'POST', field, function (result) {

                    flag = false;

                    if(result.status === 1){

                        common.show('success', result.message, function () {

                            parent.layui.loader.open(18);

                            parent.layui.table.reload('admin-users-list'); //重载表格

                            parent.layer.close(index); //再执行关闭

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




