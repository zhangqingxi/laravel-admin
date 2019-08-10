@extends('admin.layout.main', ['autoload' => 2])

@section('content')

    <div class="layui-fluid" id="admin-roles-main">

        <div class="layui-card">

            <div class="layui-form layui-card-header layuiadmin-card-header-auto">

                <div class="layui-form-item">

                    <div class="layui-inline">

                        <label for="name" class="layui-form-label">角色名</label>

                        <div class="layui-input-inline">

                            <input id="name" name="name" type="text" placeholder="请输入角色名" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-inline" >

                        <label for="status" class="layui-form-label">角色状态</label>

                        <div class="layui-input-inline">

                            <select id="status" name="status">

                                <option value="">全部</option>

                                <option value="1">正常</option>

                                <option value="0">禁用</option>

                            </select>

                        </div>

                    </div>

                    <div class="layui-inline">

                        <button class="layui-btn" lay-submit lay-filter="admin-roles-search">

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

                    @can('roles/add')

                    <button class="layui-btn" data-type="add">添加</button>

                    @endCan

                    @can('roles/edit')

                    <button class="layui-btn" data-type="enableChecked">启用</button>

                    <button class="layui-btn" data-type="disableChecked">禁用</button>

                    @endcan

                </div>

                <table id="admin-roles-list" lay-filter="admin-roles-list"></table>

            </div>

        </div>

    </div>


    <script type="text/html" id="item-operation">

        @can('roles/permission')

        <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="add">

            <i class="layui-icon layui-icon-add-1"></i>权限设置

        </a>

        @endcan

        @can('roles/edit')

        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit">

            <i class="layui-icon layui-icon-edit"></i>编辑

        </a>

        @endcan

        @can('roles/delete')

        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete">

            <i class="layui-icon layui-icon-delete"></i>删除

        </a>

        @endcan

    </script>

    <script type="text/html" id="item-permission">

        @{{#  if(d.permissions.length === 0){ }}

        <button class="layui-btn layui-btn-xs layui-btn-disabled">暂无权限</button>

        @{{#  } else { }}

        <button class="layui-btn layui-btn-xs" @can('roles/permission') lay-event="add"  @endcan>查看权限</button>

        @{{#  } }}

    </script>


    <script type="text/html" id="item-status">

        @{{#  if(d.status === 1 ){ }}

        <button class="layui-btn layui-btn-xs layui-btn-success" @can('roles/edit') lay-event="disable" @endcan>显示</button>

        @{{#  } else { }}

        <button class="layui-btn layui-btn-xs layui-btn-warning" @can('roles/edit') lay-event="enable" @endcan>禁用</button>

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
            form.on('submit(admin-roles-search)', function(data){
                let field = data.field;
                active.tableReload(field);
            });

            //监听工具条
            table.on('tool(admin-roles-list)', function(obj){

                let data = obj.data,id = data.id;

                if(id === '' || id === 0){

                    common.show('warning', '没有获取到资源ID');

                    return false;

                }

                if(obj.event === 'add'){

                    let url = "{{url('roles/permission')}}/"+ id;

                    common.openIframe('设置权限', url, ['45%', '80%'], ['提交'],

                        function (index, layero) {},//取消回调处理

                        function (index, layero) {//执行回调处理

                            //点击确认触发 iframe 内容中的按钮提交

                            let submit = layero.find('iframe').contents().find("#admin-roles-permission-submit");

                            submit.click();

                        }

                    );

                } else if(obj.event === 'edit'){

                    let url = "{{url('roles/edit')}}/"+ id;

                    common.openIframe('编辑角色', url, ['30%', '30%'], ['提交'],

                        function (index, layero) {},//取消回调处理

                        function (index, layero) {//执行回调处理

                            //点击确认触发 iframe 内容中的按钮提交

                            let submit = layero.find('iframe').contents().find("#admin-roles-edit-submit");

                            submit.click();

                        }

                    );

                } else if(obj.event === 'delete'){

                    layer.confirm('确定要执行删除角色操作吗?', function(index){

                        let url = "{{url('roles/delete')}}/"+ id;

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


                }else if(obj.event === 'disable'){

                    active.changeRoleStatus(obj, id, 0);

                } else if(obj.event === 'enable'){

                    active.changeRoleStatus(obj, id, 1);

                } else{

                    common.show('warning', '找不到执行的入口');

                }

            });

            let active = {
                //添加角色
                add:function(){

                    let url = "{{url('roles/add')}}";

                    common.openIframe('添加角色', url, ['30%', '30%'], ['提交'],

                        function (index, layero) {},//取消回调处理

                        function (index, layero) {//执行回调处理

                            //点击确认触发 iframe 内容中的按钮提交

                            let submit = layero.find('iframe').contents().find("#admin-roles-add-submit");

                            submit.click();

                        }

                    );

                },
                //表格数据重载
                tableReload: function(whereField = []){ //获取选中数目
                    loader.open(18);
                    table.reload('admin-roles-list', {where:whereField});
                },
                //表格数据初始化
                tableRender:function () {
                    // 渲染表格
                    table.render({
                        elem: '#admin-roles-list',
                        url: '{{url('roles/list')}}',
                        title: '系统日志',
                        loading:true,
                        cellMinWidth: 80,
                        cols: [[
                            {type:'checkbox', fixed: 'left'},
                            {field: 'id', title: 'ID',width:80},
                            {field: 'name', title: '角色名'},
                            {field: 'remark', title: '角色描述'},
                            {align:'center',title: '权限',toolbar: '#item-permission',width:120},
                            {align:'center', title: '状态', toolbar: '#item-status',width:80},
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
                        done:function(){
                            $('.layui-laypage-next,.layui-laypage-prev,.layui-laypage-btn').unbind('click').on('click', function () {
                                loader.open(18);
                            })
                        }
                    });
                },
                //角色的启用与禁用
                changeRoleStatus:function(obj, id, status){

                    let title = status === 1 ? '启用角色' : '禁用角色';

                    layer.confirm('确定要执行'+title+'操作吗?', function(index) {

                        layer.close(index);

                        let url = '{{url('roles/status')}}' + '/' + id;

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
                //批量启用角色
                enableChecked:function(){

                    let checkStatus = table.checkStatus('admin-roles-list')
                        ,data = checkStatus.data;

                    if(data.length === 0){

                        common.show('warning', '请选择数据');

                        return false;

                    }

                    layer.confirm('确定要批量执行启用角色操作吗?', function(index) {

                        let ids = [];

                        layer.close(index);

                        for(let i = 0; i < data.length; i++){

                            ids.push(data[i].id);

                        }

                        let url = '{{url('roles/statusAll')}}';

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

                    let checkStatus = table.checkStatus('admin-roles-list')
                        ,data = checkStatus.data;

                    if(data.length === 0){

                        common.show('warning', '请选择数据');

                        return false;

                    }

                    layer.confirm('确定要批量执行禁用角色操作吗?', function(index) {

                        let ids = [];

                        layer.close(index);

                        for(let i = 0; i < data.length; i++){

                            ids.push(data[i].id);

                        }

                        let url = '{{url('roles/statusAll')}}';

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
                //刷新
                refresh:function () {
                    $('#admin-roles-main input[name=name], #admin-roles-main select[name=status]').val("");
                    form.render('select');
                    active.tableReload();
                }
            };

            active.tableRender();

            //监听点击事件
            $('#admin-roles-main .layui-btn').unbind('click').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

        });
    </script>

@endsection




