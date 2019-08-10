@extends('admin.layout.main', ['autoload' => 2])

@section('content')

    <div class="layui-fluid admin-posts-main">

        <div class="layui-card">

            <div class="layui-form layui-card-header layuiadmin-card-header-auto">

                <div class="layui-form-item">

                    <div class="layui-inline">

                        <label for="admin-posts-title" class="layui-form-label">文章标题</label>

                        <div class="layui-input-inline">

                            <input id="admin-posts-title" name="title" type="text" placeholder="请输入文章标题" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-inline">

                        <label for="admin-posts-status" class="layui-form-label">发布状态</label>

                        <div class="layui-input-inline">

                            <select id="admin-posts-status" name="status">

                                <option value="">全部</option>

                                <option value="1">已发布</option>

                                <option value="0">待发布</option>

                            </select>

                        </div>

                    </div>

                    <div class="layui-inline">

                        <button class="layui-btn" lay-submit lay-filter="admin-posts-search">

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

                    @can('posts/add')

                    <button class="layui-btn" data-type="addPost">添加</button>

                    @endcan

                    @can('posts/edit')

                    <button class="layui-btn" data-type="enableChecked">启用</button>

                    <button class="layui-btn" data-type="disableChecked">禁用</button>

                    @endcan

                </div>

                <table id="admin-posts-list" lay-filter="admin-posts-list"></table>

            </div>

        </div>

    </div>

    <script type="text/html" id="item_status">

        @{{#  if(d.status === 1 ){ }}

        <button class="layui-btn layui-btn-xs layui-btn-danger" @can('posts/edit') lay-event="disable" @endcan>已发布</button>

        @{{#  } else { }}

        <button class="layui-btn layui-btn-xs layui-btn-warning" @can('posts/edit') lay-event="enable" @endcan>待发布</button>

        @{{#  } }}

    </script>

    <script type="text/html" id="item_operation">

        @can('posts/role')

        <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="preview">

            <i class="layui-icon layui-icon-release"></i>预览

        </a>

        @endcan

        @can('posts/edit')

        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit">

            <i class="layui-icon layui-icon-edit"></i>编辑

        </a>

        @endcan

        @can('posts/delete')

        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete">

            <i class="layui-icon layui-icon-delete"></i>删除

        </a>

        @endcan

    </script>

    <script type="text/html" id="item_image">


        @{{#  if(d.image.length === 0){ }}

        <button class="layui-btn layui-btn-xs layui-btn-disabled">暂无图片</button>

        @{{#  } else { }}

        <button class="layui-btn layui-btn-xs" @can('users/role') lay-event="add" @endcan>预览图片</button>

        @{{#  } }}

    </script>

    <script type="text/html" id="item_comment">


        @{{#  if(d.image.length === 0){ }}

        <button class="layui-btn layui-btn-xs layui-btn-disabled">暂无图片</button>

        @{{#  } else { }}

        <button class="layui-btn layui-btn-xs" @can('users/role') lay-event="add" @endcan>预览图片</button>

        @{{#  } }}

    </script>

    <script type="text/html" id="item_top">


        @{{#  if(d.image.length === 0){ }}

        <button class="layui-btn layui-btn-xs layui-btn-disabled">暂无图片</button>

        @{{#  } else { }}

        <button class="layui-btn layui-btn-xs" @can('users/role') lay-event="add" @endcan>预览图片</button>

        @{{#  } }}

    </script>

    <script type="text/html" id="item_user">

        @{{#  if(d.user.length === 0){ }}

        <button class="layui-btn layui-btn-xs layui-btn-disabled">暂无图片</button>

        @{{#  } else { }}

        <button class="layui-btn layui-btn-xs" @can('users/role') lay-event="add" @endcan>预览图片</button>

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
            form.on('submit(admin-posts-search)', function(data){
                let field = data.field;
                active.tableReload(field);
            });

            //监听工具条
            table.on('tool(admin-posts-list)', function(obj){

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

                    common.openIframe('编辑用户', url, ['30%', '30%'], ['提交'],

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
                //添加文章
                addPost: function(){

                    let url = '{{url('posts/add')}}';

                    common.openIframe('添加文章', url, ['60%', '80%'], ['提交'],

                        function (index, layero) {},//取消回调处理

                        function (index, layero) {//执行回调处理

                            //点击确认触发 iframe 内容中的按钮提交

                            let submit = layero.find('iframe').contents().find("#admin-posts-add-submit");

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
                        elem: '#admin-posts-list',
                        url: '{{url('posts/list')}}',
                        title: '系统日志',
                        loading:true,
                        cellMinWidth: 80,
                        cols: [[
                            {type:'checkbox', fixed: 'left'},
                            {field: 'id', title: 'ID',width:80},
                            {align:'center', title: '发布者',width:80,toolbar: '#item-user'},
                            {field: 'title', title: '标题',width:200},
                            {align:'center', title: '图片',width:120,toolbar: '#item-image'},
                            {field: 'hits', title: '浏览量',width:80},
                            {align:'center', title: '是否允许评论', width:120,toolbar: '#item-comment'},
                            {align:'center', title: '是否允许置顶', width:120,toolbar: '#item-top'},
                            {field: 'status', align:'center',title: '状态', toolbar: '#item-status',width:80},
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
            $('.admin-posts-main .layui-btn').unbind('click').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

        });
    </script>

@endsection




