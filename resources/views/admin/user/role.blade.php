@extends('admin.layout.main', ['autoload' => 2])

@section('content')

    <div class="layui-fluid" id="admin-users-role">

        <div class="layui-card">

            <div class="layui-card-body" pad15>

                <div class="layui-form">

                    <input type="hidden" value="{{isset($adminUser->id) ? $adminUser->id : 0 }}" id="id"/>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="role">分配角色</label>

                        <div class="layui-input-block">

                            <select name="role_ids" id="role" xm-select="admin-users-role" xm-select-skin="primary" xm-select-search>

                                <option value="">请选择角色</option>

                            </select>

                        </div>

                    </div>

                    <div class="layui-form-item layui-hide">

                        <button class="layui-btn" lay-submit lay-filter="admin-users-role-submit" id="admin-users-role-submit">立即提交</button>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>

        layui.extend({

            formSelects : '{/} {{asset('static/common/formSelects/formSelects-v4')}}',

        }).use(['formSelects', 'form', 'common'], function(){

            const $ = layui.$,
                form = layui.form,
                formSelects = layui.formSelects,
                common = layui.common,
                loader = layui.loader;

            let adminUserId = $('#admin-users-role #id').val(),
                adminUserRoles = "{{$adminUserRoles}}";

            formSelects.data('admin-users-role', 'server', {
                response: {
                    statusCode: 0,          //成功状态码
                    statusName: 'code',     //code key
                    msgName: 'msg',         //msg key
                    dataName: 'data'        //data key
                },
                keyName: 'name',            //自定义返回数据中name的key, 默认 name
                keyVal:  'id',            //自定义返回数据中value的key, 默认 value
                keyChildren: 'children',    //联动多选自定义children
                url:"{{url('roles/list')}}",
                direction: 'down',          //多选下拉方向, auto|up|down
                beforeSuccess: function(id, url, searchVal, result){
                    loader.close(18);
                    result = result.data.data;
                    //然后返回数据
                    return result;
                },
                success:function (id, url, searchVal, result) {
                    //设置默认值
                    adminUserRoles = adminUserRoles ? JSON.parse( adminUserRoles ) : [];
                    formSelects.value('admin-users-role', adminUserRoles, true);
                },
                error: function(id, url, searchVal, err){           //使用远程方式的error回调
                    loader.close(18);
                },
            });

            let flag = false;
            //监听提交
            form.on('submit(admin-users-role-submit)', function(data){

                let field = data.field; //获取提交的字段

                if(field.role_ids.length === 0){

                    common.show('warning', '请至少分配一项角色');

                    return false;

                }

                let index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

                let url = "{{url('users/role')}}" + '/' + adminUserId;

                if(flag) return false;

                flag = true;

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




