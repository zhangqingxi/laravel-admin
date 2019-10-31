@extends('admin.layout.main', ['autoload' => 2])

@section('content')

    <div class="layui-fluid" id="admin-users-main">

        <div class="layui-card">

            <div class="layui-form layui-card-header layuiadmin-card-header-auto">

                <div class="layui-form-item">

                    <div class="layui-inline">

                        <label for="username" class="layui-form-label">用户信息</label>

                        <div class="layui-input-inline">

                            <input id="username" name="username" type="text" placeholder="请输入用户ID、用户名或用户昵称" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-inline">

                        <label for="status" class="layui-form-label">用户状态</label>

                        <div class="layui-input-inline">

                            <select id="status" name="status">

                                <option value="">全部</option>

                                <option value="1">正常</option>

                                <option value="0">禁用</option>

                            </select>

                        </div>

                    </div>

                    <div class="layui-inline">

                        <button class="layui-btn" lay-submit lay-filter="admin-users-search">

                            <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>

                        </button>

                        <button class="layui-btn"  data-type="refresh">

                            <i class="layui-icon layui-icon-refresh layuiadmin-button-btn"></i>

                        </button>

                    </div>

                </div>

            </div>

            <div class="layui-card-body">

                <div style="padding-bottom: 10px;">

                    @can('users/add')

                    <button class="layui-btn" data-type="add">添加</button>

                    @endcan

                    @can('users/edit')

                    <button class="layui-btn" data-type="enableChecked">启用</button>

                    <button class="layui-btn" data-type="disableChecked">禁用</button>

                    @endcan

                </div>

                <table id="admin-users-list" lay-filter="admin-users-list"></table>

            </div>

        </div>

    </div>

    <script type="text/html" id="item-status">

        @{{#  if(d.status === 1 ){ }}

            @{{#  if(d.is_admin === true ){ }}

            <button class="layui-btn layui-btn-xs layui-btn-disabled">显示</button>

            @{{#  } else { }}

            <button class="layui-btn layui-btn-xs"  @can('users/edit') lay-event="disable" @endcan>显示</button>

            @{{#  } }}

        @{{#  } else { }}

        <button class="layui-btn layui-btn-xs layui-btn-danger" @can('users/edit') lay-event="enable" @endcan>禁用</button>

        @{{#  } }}

    </script>

    <script type="text/html" id="item-operation">

        @can('users/role')

        @{{#  if(d.is_admin === false ){ }}

        <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="add">

            <i class="layui-icon layui-icon-add-1"></i>角色设置

        </a>

        @{{#  } }}

        @endcan

        @can('users/edit')

        @{{#  if(d.is_admin === true ){ }}

        <a class="layui-btn layui-btn-xs layui-btn-disabled">

            <i class="layui-icon layui-icon-edit"></i>编辑

        </a>

        @{{#  } else { }}

        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit">

            <i class="layui-icon layui-icon-edit"></i>编辑

        </a>

        @{{#  } }}

        @endcan

        @can('users/delete')

        @{{#  if(d.is_admin === true ){ }}

        <a class="layui-btn layui-btn-xs layui-btn-disabled">

            <i class="layui-icon layui-icon-delete"></i>删除

        </a>

        @{{#  } else { }}

        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete">

            <i class="layui-icon layui-icon-delete"></i>删除

        </a>

        @{{#  } }}

        @endcan

    </script>

    <script type="text/html" id="item-roles">

        @{{#  if(d.is_admin === true ){ }}

        <button class="layui-btn layui-btn-xs layui-btn-disabled">所有权限</button>

        @{{#  } else { }}

            @{{#  if(d.roles.length === 0){ }}

            <button class="layui-btn layui-btn-xs layui-btn-disabled">暂无角色</button>

            @{{#  } else { }}

            <button class="layui-btn layui-btn-xs" @can('users/role') lay-event="add" @endcan>查看角色</button>

            @{{#  } }}

        @{{#  } }}

    </script>

    <script>

        layui.use(['table', 'laydate'], function(){

            let $ = layui.$,
                table = layui.table,
                loader = layui.loader,
                form = layui.form,
                layDate = layui.laydate,
                common = layui.common;


            //监听搜索
            form.on('submit(admin-users-search)', function(data){
                let field = data.field;
                active.tableReload(field);
            });

            //监听工具条
            table.on('tool(admin-users-list)', function(obj){

                let data = obj.data,id = data.id;

                if(id === '' || id === 0){

                    common.show('warning', '没有获取到资源ID');

                    return false;

                }

                if(obj.event === 'add'){

                    let url = "{{url('users/role')}}/"+ id;

                    common.openIframe('设置角色', url, ['50%', '50%'], ['提交'],

                        function (index, layero) {},//取消回调处理

                        function (index, layero) {//执行回调处理

                            //点击确认触发 iframe 内容中的按钮提交

                            let submit = layero.find('iframe').contents().find("#admin-users-role-submit");

                            submit.click();

                        }

                    );

                } else if(obj.event === 'edit'){

                    let url = "{{url('users/edit')}}/"+ id;

                    common.openIframe('编辑用户', url, ['50%', '50%'], ['提交'],

                        function (index, layero) {},//取消回调处理

                        function (index, layero) {//执行回调处理

                            //点击确认触发 iframe 内容中的按钮提交

                            let submit = layero.find('iframe').contents().find("#admin-users-edit-submit");

                            submit.click();

                        }

                    );

                }else if(obj.event === 'delete'){

                    layer.confirm('确定要执行删除用户操作吗?', function(index){

                        let url = "{{url('users/delete')}}/"+ id;

                        layer.close(index);

                        common.ajax(url, 'DELETE', data, function (result) {

                            if(result.status === 1){

                                common.show('success', result.message, function () {

                                    obj.del();

                                });

                            }else{

                                common.show('info', result.message);

                            }

                        },function(){

                            common.show('error', '服务器异常');

                        });

                    });


                } else if(obj.event === 'disable'){

                    active.changeUserStatus(obj, id, 0);

                } else if(obj.event === 'enable'){

                    active.changeUserStatus(obj, id, 1);

                } else{

                    common.show('warning', '找不到执行的入口');

                }

            });

            let active = {
                //添加用户
                add: function(){

                    let url = '{{url('users/add')}}';

                    common.openIframe('添加角色', url, ['30%', '40%'], ['提交'],

                        function (index, layero) {},//取消回调处理

                        function (index, layero) {//执行回调处理

                            //点击确认触发 iframe 内容中的按钮提交

                            let submit = layero.find('iframe').contents().find("#admin-users-add-submit");

                            submit.click();

                        }

                    );

                },
                //表格数据重载
                tableReload: function(whereField = []){ //获取选中数目
                    loader.open(18);
                    table.reload('admin-users-list', {where:whereField});
                },
                //批量启用用户
                enableChecked:function(){

                    let checkStatus = table.checkStatus('admin-users-list')
                        ,data = checkStatus.data;

                    if(data.length === 0){

                        common.show('warning', '请选择数据');

                        return false;

                    }

                    layer.confirm('确定要批量执行启用用户操作吗?', function(index) {

                        let ids = [];

                        layer.close(index);

                        for(let i = 0; i < data.length; i++){

                            ids.push(data[i].id);

                        }

                        let url = '{{url('users/statusAll')}}';

                        common.ajax(url, 'PUT', {ids:ids, status: 1}, function (result) {

                            if(result.status === 1){

                                common.show('success', result.message, function () {

                                    active.tableReload();

                                });

                            }else{

                                common.show('info', result.message);

                            }

                        },function(){

                            common.show('error', '服务器异常');

                        });

                    });

                },
                //批量启用角色
                disableChecked:function(){

                    let checkStatus = table.checkStatus('admin-users-list')
                        ,data = checkStatus.data;

                    if(data.length === 0){

                        common.show('warning', '请选择数据');

                        return false;

                    }

                    layer.confirm('确定要批量执行禁用用户操作吗?', function(index) {

                        let ids = [];

                        layer.close(index);

                        for(let i = 0; i < data.length; i++){

                            ids.push(data[i].id);

                        }

                        let url = '{{url('users/statusAll')}}';

                        common.ajax(url, 'PUT', {ids:ids, status: 0}, function (result) {

                            if(result.status === 1){

                                common.show('success', result.message, function () {

                                    active.tableReload();

                                });

                            }else{

                                common.show('info', result.message);

                            }

                        },function(){

                            common.show('error', '服务器异常');

                        });

                    });

                },
                //表格数据初始化
                tableRender:function () {
                    table.render({
                        elem: '#admin-users-list',
                        url: '{{url('users/list')}}',
                        title: '用户管理',
                        loading:true,
                        cellMinWidth: 80,
                        cols: [[
                            {type:'checkbox', fixed: 'left'},
                            {field: 'id', title: 'ID',width:80},
                            {field: 'username', title: '用户名',width:120},
                            {field: 'nickname', title: '用户昵称',width:120},
                            {field: 'last_login_ip', title: '登录ip',width:120},
                            {field: 'updated_at', title: '登录时间'},
                            {field: 'created_at', title: '注册时间'},
                            {align:'center',title: '角色', toolbar: '#item-roles',width:120},
                            {align:'center',title: '状态', toolbar: '#item-status',width:80},
                            {fixed: 'right', align:'center', title: '操作',  toolbar: '#item-operation'},
                        ]],
                        page: {
                            layout: ['count', 'prev', 'page', 'next', 'skip'], //自定义分页布局
                            curr: 1, //设定初始在第 5 页
                            groups: 1, //只显示 1 个连续页码
                            first: false, //不显示首页
                            last: false, //不显示尾页
                        },
                        response: {
                            statusCode: 1 //重新规定成功的状态码为 1，table 组件默认为 0
                        },
                        parseData: function (res) { //将原始数据解析成 table 组件所规定的数据
                            loader.close(18);
                            return {
                                "code": res.status, //解析接口状态
                                "msg": res.message, //解析提示文本
                                "count": res.data.total, //解析数据长度
                                "data": res.data.data //解析数据列表
                            };
                        },
                        done:function(res){
                            $('.layui-laypage-next,.layui-laypage-prev,.layui-laypage-btn').unbind('click').on('click', function () {
                                loader.open(18);
                            })
                        }
                    });
                },
                //用户的启用与禁用
                changeUserStatus:function(obj, id, status){

                    let title = status === 1 ? '启用用户' : '禁用用户';

                    layer.confirm('确定要执行'+title+'操作吗?', function(index) {

                        layer.close(index);

                        let url = '{{url('users/status')}}' + '/' + id;

                        common.ajax(url, 'PUT', {status:status}, function (result) {

                            if(result.status === 1){

                                common.show('success', result.message, function () {

                                    if(status === 1){

                                        obj.update({

                                            status: '<button class="layui-btn layui-btn-xs layui-btn-success" lay-event="disable">显示</button>'

                                        });

                                    }else{

                                        obj.update({

                                            status: '<button class="layui-btn layui-btn-xs layui-btn-warning" lay-event="enable">禁用</button>'

                                        });

                                    }

                                });

                            }else{

                                common.show('info', result.message);

                            }

                        },function(){

                            common.show('error', '服务器异常');

                        });

                    });

                },
                //刷新
                refresh:function () {
                    active.tableRender();
                }
            };

            active.tableRender();

            //监听点击事件
            $('#admin-users-main .layui-btn').unbind('click').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

        });
    </script>

@endsection




