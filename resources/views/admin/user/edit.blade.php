@extends('admin.layout.main', ['autoload' => 1])

@section('content')

    <div class="layui-fluid" id="admin-users-edit">

        <div class="layui-card">

            <div class="layui-card-body" pad15>

                <input type="hidden" id="id" value="{{$adminUser->id}}"/>

                <div class="layui-form">

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="username">用户名称</label>

                        <div class="layui-input-block">

                            <input type="text" id="username" value="{{$adminUser->username}}" lay-verify="required" name="username" placeholder="请输入用户名称" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="nickname">用户昵称</label>

                        <div class="layui-input-block">

                            <input type="text" id="nickname" value="{{$adminUser->nickname}}" lay-verify="required" name="nickname" placeholder="请输入用户昵称" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="password">用户密码</label>

                        <div class="layui-input-block">

                            <input type="password" id="password" value="" name="password" placeholder="******" autocomplete="off" class="layui-input">

                            <div class="tips">不输入则不修改</div>

                        </div>


                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="status">用户状态</label>

                        <div class="layui-input-block">

                            <input type="checkbox" id="status" @if($adminUser->status === 1) checked @endif lay-filter="status" name="status" value="1" lay-skin="switch" lay-text="启用|禁用">

                        </div>

                    </div>

                    <div class="layui-form-item layui-hide">

                        <button class="layui-btn" lay-submit lay-filter="admin-users-edit-submit" id="admin-users-edit-submit">立即提交</button>

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
            let roleId = $('#admin-users-edit #id').val();
            //监听提交
            form.on('submit(admin-users-edit-submit)', function(data){

                let field = data.field; //获取提交的字段

                let index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

                let url = "{{url('users/edit')}}"+'/'+roleId;

                let __self = $('#admin-users-edit-submit');

                __self.attr('disable', true);

                field.status = field.status ? 1 : 0;

                if(field.password === ''){

                    delete field.password;

                }

                common.ajax(url, 'PUT', field, function (result) {

                    __self.attr('disable', false);

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

                        __self.attr('disable', false);

                    });

                });

            });

        });

    </script>

@endsection




