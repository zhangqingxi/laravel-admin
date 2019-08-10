@extends('admin.layout.main', ['autoload' => 2])

@section('content')

    <div class="layui-fluid" id="admin-system-logs-main">

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

                        <button class="layui-btn" lay-submit lay-filter="admin-system-logs-search">

                            <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>

                        </button>

                        <button class="layui-btn" data-type="refresh">

                            <i class="layui-icon layui-icon-refresh layuiadmin-button-btn"></i>

                        </button>

                    </div>

                </div>

            </div>

            <div class="layui-card-body">

                <div style="padding-bottom: 10px;">

                    @can('systemLogs/clear')

                    <button class="layui-btn" data-type="clearLogs">清空日志</button>

                    @endcan

                </div>

                <table id="admin-system-logs-list" lay-filter="admin-system-logs-list"></table>

            </div>

        </div>

    </div>

    <script type="text/html" id="item-method">

        @{{#  if(d.method == 'GET'){ }}

        <button class="layui-btn layui-btn-xs">GET</button>

        @{{#  } else if(d.method == 'POST') { }}

        <button class="layui-btn layui-btn-normal layui-btn-xs">POST</button>

        @{{#  } else if(d.method == 'PUT') { }}

        <button class="layui-btn layui-btn-danger layui-btn-xs">PUT</button>

        @{{#  } else if(d.method == 'DELETE') { }}

        <button class="layui-btn layui-btn-warm layui-btn-xs">DELETE</button>

        @{{#  } else if(d.method == 'DELETE') { }}

        <button class="layui-btn layui-btn-radius layui-btn-xs">@{{ d.method }}</button>

        @{{#  } }}

    </script>

    <script type="text/html" id="item-content">

        <button class="layui-btn layui-btn-xs" lay-event="showContent">查看内容</button>

    </script>


    <script>
        layui.use(['table', 'laydate', 'common'], function(){

            let $ = layui.$,
                table = layui.table,
                loader = layui.loader,
                form = layui.form,
                layDate = layui.laydate,
                common = layui.common;

            //日期时间范围
            layDate.render({
                elem: '#admin-system-logs-main #date-range',
                type: 'datetime',
                range: '~',
            });

            //监听搜索
            form.on('submit(admin-system-logs-search)', function(data){
                let field = data.field;
                active.tableReload(field);
            });

            //监听工具条
            table.on('tool(admin-system-logs-list)', function(obj){

                let data = obj.data,id = data.id;

                if(id === '' || id === 0){

                    common.show('warning', '没有获取到资源ID');

                    return false;

                }

                if(obj.event === 'showContent'){

                    let content = '<div class="admin-system-logs-show-content"><h2>'+data['table_name']+'</h2><br/>'+data['content']+' </div>';

                    common.openPage('内容', content, ['30%', '40%']);

                } else{

                    common.show('error', '找不到执行的入口');

                }

            });

            let active = {
                // 重载表格
                tableReload: function(whereField = []){ //获取选中数目
                    loader.open(18);
                    table.reload('admin-system-logs-list', {where:whereField});
                },
                // 渲染表格
                tableRender:function () {
                    table.render({
                        elem: '#admin-system-logs-list',
                        url: '{{url('systemLogs/list')}}',
                        title: '系统日志',
                        loading:true,
                        cellMinWidth: 80,
                        cols: [[
                            {field: 'id', title: 'ID', width:80},
                            {field: 'admin_user_id', title: '用户ID',width:80},
                            {field: 'route', title: '操作路由', width:200},
                            {title: '操作方法', toolbar: '#item-method',width:120},
                            {field: 'ip', title: 'IP',width:120},
                            {field: 'title', title: '标题',width:120},
                            {field: 'table_name', title: '数据模型',width: 300,},
                            {field: 'table_id', title: '模型ID',width:80},
                            {align:'center',title: '操作内容', toolbar: '#item-content',width:120},
                            {field: 'created_at', title: '操作时间'},
                        ]],
                        page: {
                            layout: ['count', 'prev', 'page', 'next', 'skip'], //自定义分页布局
                            curr: 1, //设定初始在第 5 页
                            groups: 7, //只显示 7 个连续页码
                            first: false, //不显示首页
                            last: false, //不显示尾页
                            limit:10
                        },
                        response: {
                            statusCode: 1 //重新规定成功的状态码为 1，table 组件默认为 0
                        },
                        parseData: function (res) { //将原始数据解析成 table 组件所规定的数据
                            return {
                                "code": res.status, //解析接口状态
                                "msg": res.message, //解析提示文本
                                "count": res.data.total, //解析数据长度
                                "data": res.data.data //解析数据列表
                            };
                        },
                        done:function(){
                            loader.close(18);
                            $('.layui-laypage a,.layui-laypage .layui-laypage-btn').unbind('click').on('click', function () {
                                loader.open(18);
                            })
                        }
                    });
                },
                //清空日志
                clearLogs:function () {

                    layer.confirm('确定要执行清空日志操作吗?', function(index){

                        let url = "{{url('systemLogs/delete')}}";

                        layer.close(index);

                        common.ajax(url, 'DELETE', {}, function (result) {

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
                    $('#admin-system-logs-main #date-range').val('');
                    active.tableReload();
                }

            };

            //初始化
            active.tableRender();

            //监听点击事件
            $('#admin-system-logs-main .layui-btn').unbind('click').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

        });
    </script>

@endsection




