@extends('admin.layout.main', ['autoload' => 1])

@section('content')

    <div class="layui-fluid" id="admin-roles-edit">

        <div class="layui-card">

            <div class="layui-card-body" pad15>

                <input type="hidden" id="admin-roles-id" value="{{$adminRole->id}}"/>

                <div class="layui-form">

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="name">角色名称</label>

                        <div class="layui-input-block">

                            <input type="text" id="name" value="{{$adminRole->name}}" lay-verify="required" name="name" placeholder="请输入角色名称" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="remark">角色备注</label>

                        <div class="layui-input-block">

                            <input type="text" id="remark" value="{{$adminRole->remark}}" lay-verify="required" name="remark" placeholder="请输入角色备注" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="status">角色状态</label>

                        <div class="layui-input-block">

                            <input type="checkbox" id="status" @if($adminRole->status === 1) checked @endif lay-filter="status" name="status" value="1" lay-skin="switch" lay-text="启用|禁用">

                        </div>

                    </div>

                    <div class="layui-form-item layui-hide">

                        <button class="layui-btn" lay-submit lay-filter="admin-roles-edit-submit" id="admin-roles-edit-submit">立即提交</button>

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
            let roleId = $('#admin-roles-id').val();
            let flag = false;
            //监听提交
            form.on('submit(admin-roles-edit-submit)', function(data){

                let field = data.field; //获取提交的字段

                let index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

                let url = "{{url('roles/edit')}}"+'/'+roleId;

                if(flag) return false;

                flag = true;

                field.status = field.status ? 1 : 0;

                common.ajax(url, 'PUT', field, function (result) {

                    flag = false;

                    if(result.status === 1){

                        common.show('success', result.message, function () {

                            parent.layui.loader.open(18);

                            parent.layui.table.reload('admin-roles-list'); //重载表格

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




