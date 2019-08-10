@extends('admin.layout.main', ['autoload' => 2])

@section('content')

    <div class="layui-fluid" id="admin-menus-main">

        <div class="layui-card">

            <div class="layui-form layui-card-header layuiadmin-card-header-auto">

                <div class="layui-form-item">

                    <div class="layui-inline">

                        <div class="layui-input-inline">

                            <label for="keyword"></label>

                            <input id="keyword" name="keyword" type="text" placeholder="输入菜单关键字" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-inline">

                        <button class="layui-btn" lay-submit lay-filter="admin-menus-search">

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

                    <button class="layui-btn" data-type="open">全部展开</button>

                    <button class="layui-btn" data-type="close">全部折叠</button>

                    @can('menus/add')

                    <button class="layui-btn" data-type="add">添加菜单</button>

                    @endcan

                </div>

                <table id="admin-menus-list" lay-filter="admin-menus-list"></table>

            </div>

        </div>

    </div>

    <script type="text/html" id="item-status">
        @{{#  if(d.status){ }}
        <button class="layui-btn layui-btn-xs">显示</button>
        @{{#  } else { }}
        <button class="layui-btn layui-btn-primary layui-btn-xs">隐藏</button>
        @{{#  } }}
    </script>

    <script type="text/html" id="item-operation">

        @can('menus/add')

        <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="add">

            <i class="layui-icon layui-icon-add-1"></i>添加子类

        </a>

        @endcan

        @can('menus/edit')
        <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit">

            <i class="layui-icon layui-icon-edit"></i>编辑

        </a>
        @endcan

        @can('menus/delete')

        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete">

            <i class="layui-icon layui-icon-delete"></i>删除

        </a>

        @endcan

    </script>

    <script>

        layui.extend({

            treeTable: '{/}' + ROOT_COMMON_URL + 'treeTable/js/treetable',

        }).use(['table', 'common', 'treeTable'], function () {

            let $ = layui.$,
                table = layui.table,
                layer = layui.layer,
                form = layui.form,
                common = layui.common,
                loader = layui.loader,
                treeTable = layui.treeTable;

            //监听搜索
            form.on('submit(admin-menus-search)', function(data){

                let field = data.field;

                let keyword = field.keyword,searchCount = 0;

                $('.admin-menus-main .list').next('.treeTable').find('.layui-table-body tbody tr td').each(function () {

                    $(this).css('background-color', 'transparent');

                    let text = $(this).text();

                    if (keyword  !== '' && text.indexOf(keyword) >= 0) {

                        $(this).css('background-color', 'rgba(250,230,160,0.5)');

                        if (searchCount === 0) {

                            treeTable.expandAll('.admin-menus-main .list');

                            $('html,body').stop(true).animate({scrollTop: $(this).offset().top - 150}, 500);

                        }

                        searchCount++;

                    }

                });

                if (keyword === '') {

                    common.show('warning', '请输入搜索内容');

                }else if (searchCount === 0) {

                    common.show('info', '没有匹配结果');

                }

            });

            let active = {
                //表格渲染
                tableRender: function () {//树桩表格参考文档：https://gitee.com/whvse/treetable-lay
                    common.treeTable('#admin-menus-list', '{{url('menus/list')}}');
                },
                //全部展开
                open:function () {
                    treeTable.expandAll('#admin-menus-list');
                },
                //全部折叠
                close:function () {
                    treeTable.foldAll('#admin-menus-list');
                },
                //添加菜单或子菜单
                add:function (parent_id = 0) {

                    let url = "{{url('menus/add')}}"+ (parent_id ? '/'+parent_id : '');

                    common.openIframe('添加菜单', url, ['45%', '90%'], ['提交'],

                        function (index, layero) {},//取消回调处理

                        function (index, layero) {//执行回调处理

                            //点击确认触发 iframe 内容中的按钮提交
                            let submit = layero.find('iframe').contents().find("#admin-menus-add-submit");

                            submit.click();

                        }

                    );

                },
                //刷新
                refresh:function () {
                    $('#admin-menus-main input[name=keyword]').val('');
                    loader.open(18);
                    active.tableRender();
                }
            };

            //监听工具条
            table.on('tool(admin-menus-list)', function(obj){

                let data = obj.data,id = data.id;

                if(id === '' || id === 0){

                    common.show('warning', '没有获取到菜单ID');

                    return false;

                }

                if(obj.event === 'delete'){

                    layer.confirm('确定要执行删除操作吗?', function(index){

                        let url = "{{url('menus/delete')}}/"+ id;

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

                } else if(obj.event === 'add'){

                    active.add(id);

                } else if(obj.event === 'edit'){

                        let url = "{{url('menus/edit')}}/"+ id;

                        common.openIframe('编辑菜单', url, ['45%', '90%'], ['提交'],

                            function (index, layero) {},//取消回调处理

                            function (index, layero) {//执行回调处理

                                //点击确认触发 iframe 内容中的按钮提交
                                let submit = layero.find('iframe').contents().find("#admin-menus-edit-submit");

                                submit.click();

                            }

                        );

                } else{

                    common.show('error', '找不到执行的入口');

                }

            });

            //初始化
            active.tableRender();

            //监听点击事件
            $('#admin-menus-main .layui-btn').unbind('click').on('click', function () {
                let type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

        });
    </script>

@endsection




