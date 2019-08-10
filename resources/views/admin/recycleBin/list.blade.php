@extends('admin.layout.main', ['autoload' => 2])

@section('content')

    <div class="layui-fluid" id="admin-recycle-bin-main">

        <div class="layui-card">

            <div class="layui-form layui-card-header layuiadmin-card-header-auto">

                <div class="layui-form-item">

                    <div class="layui-inline">

                        <div class="layui-input-inline">

                            <label for="date-range"></label>

                            <input id="date-range" name="date_range" type="text" placeholder="请选择时间范围" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-inline">

                        <button class="layui-btn" lay-submit lay-filter="admin-recycle-bin-search">

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

                    @can('recycleBin/delete')

                    <button class="layui-btn" data-type="deleteChecked">删除</button>

                    <button class="layui-btn" data-type="restoreChecked">还原</button>

                    @endcan

                </div>

                <table id="admin-recycle-bin-list" lay-filter="admin-recycle-bin-list"></table>

            </div>

        </div>

    </div>

    <script type="text/html" id="item-operation">

        @can('recycleBin/delete')

        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="restore">

            <i class="layui-icon layui-icon-edit"></i>还原

        </a>

        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete">

            <i class="layui-icon layui-icon-delete"></i>删除

        </a>

        @endcan

    </script>

    <script type="text/html" id="item-content">

        <button class="layui-btn layui-btn-xs" lay-event="showContent">查看内容</button>

    </script>

    <script>
        layui.use(['table', 'laydate'], function(){

            let $ = layui.$,
                table = layui.table,
                loader = layui.loader,
                form = layui.form,
                layDate = layui.laydate,
                common = layui.common;


            //日期时间范围
            layDate.render({
                elem: '#admin-recycle-bin-main #date-range',
                type: 'datetime',
                range: '~',
            });

            //监听搜索
            form.on('submit(admin-recycle-bin-search)', function(data){
                let field = data.field;
                active.tableReload(field);
            });

            //监听工具条
            table.on('tool(admin-recycle-bin-list)', function(obj){

                let data = obj.data,id = data.id;

                if(id === '' || id === 0){

                    common.show('warning', '没有获取到资源ID');

                    return false;

                }

                if(obj.event === 'restore'){

                    layer.confirm('确定要执行还原操作吗?', function(index){

                        let url = "{{url('recycleBin/restore')}}/"+ id;

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

                } else if(obj.event === 'delete') {

                    layer.confirm('确定要执行删除操作吗?', function (index) {

                        let url = "{{url('recycleBin/delete')}}/" + id;

                        layer.close(index);

                        common.ajax(url, 'DELETE', data, function (result) {

                            if (result.status === 1) {

                                common.show('success', result.message, function () {

                                    obj.del();

                                });

                            } else {

                                common.show('info', result.message);

                            }

                        }, function () {

                            common.show('error', '服务器异常');

                        });

                    });

                }else if(obj.event === 'showContent'){

                    let content = '<div class="admin-recycle-bin-show-content"><h2>'+data['table_name']+'</h2><br/>'+data['content']+' </div>';

                    common.openPage('内容', content, ['30%', '40%']);

                } else{

                    common.show('warning', '找不到执行的入口');

                }

            });

            let active = {
                //删除选中的数据
                deleteChecked: function(){

                    let checkStatus = table.checkStatus('admin-recycle-bin-list')
                        ,data = checkStatus.data;

                    if(data.length === 0){

                        common.show('warning', '请选择数据');

                        return false;

                    }

                    layer.confirm('确定要执行批量删除操作吗?', function(index) {

                        let ids = [];

                        layer.close(index);

                        for(let i = 0; i < data.length; i++){

                            ids.push(data[i].id);

                        }

                        let url = '{{url('recycleBin/deleteAll')}}';

                        common.ajax(url, 'DELETE', {ids:ids}, function (result) {

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
                //还原选中的数据
                restoreChecked: function(){

                    let checkStatus = table.checkStatus('admin-recycle-bin-list')
                        ,data = checkStatus.data;

                    if(data.length === 0){

                        common.show('warning', '请选择数据');

                        return false;

                    }

                    layer.confirm('确定要执行批量删除操作吗?', function(index) {

                        let ids = [];

                        layer.close(index);

                        for(let i = 0; i < data.length; i++){

                            ids.push(data[i].id);

                        }

                        let url = '{{url('recycleBin/restoreAll')}}';

                        common.ajax(url, 'DELETE', {ids:ids}, function (result) {

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
                //表格数据重载
                tableReload: function(whereField = []){ //获取选中数目
                    loader.open(18);
                    table.reload('admin-recycle-bin-list', {where:whereField});
                },
                //表格数据初始化
                tableRender:function () {
                    // 渲染表格
                    table.render({
                        elem: '#admin-recycle-bin-list',
                        url: '{{url('recycleBin/list')}}',
                        title: '系统日志',
                        loading:true,
                        cellMinWidth: 80,
                        cols: [[
                            {type:'checkbox', fixed: 'left', width: 80},
                            {field: 'id', title: 'ID', width: 120},
                            {field: 'admin_user_id', title: '用户ID', width: 120},
                            {field: 'ip', title: 'IP',width:120},
                            {field: 'table_name', title: '数据模型', width: 300},
                            {field: 'table_id', title: '模型ID', width: 120},
                            {align:'center', title: '操作内容', toolbar: '#item-content',width:120},
                            {field: 'created_at', title: '时间'},
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
                //刷新
                refresh:function () {
                    $('#admin-recycle-bin-main #date-range').val('');
                    active.tableReload();
                }
            };

            active.tableRender();

            //监听点击事件
            $('#admin-recycle-bin-main .layui-btn').unbind('click').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

        });
    </script>

@endsection




