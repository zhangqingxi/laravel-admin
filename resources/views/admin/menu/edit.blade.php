@extends('admin.layout.main', ['autoload' => 2])

@section('content')

    <div class="layui-fluid" id="admin-menus-edit">

        <div class="layui-card">

            <div class="layui-card-body" pad15>

                <div class="layui-form">

                    <input type="hidden" id="id" value="{{$adminMenu->id}}"/>

                    <input type="hidden" id="parent-id" value="{{$adminMenu->parent_id}}"/>

                    <div class="layui-form-item">

                    <label class="layui-form-label" for="parent_id">上级菜单</label>

                    <div class="layui-input-block">

                        <select name="parent_id" id="parent_id" xm-select="admin-menus-list" xm-select-skin="primary" xm-select-search xm-select-radio>

                            <option value="">作为顶级菜单</option>

                        </select>

                    </div>

                </div>

                    <div class="layui-form-item">

                    <label class="layui-form-label" for="sort">排序编号</label>

                    <div class="layui-input-block">

                        <input type="number" id="sort" name="sort" value="{{$adminMenu->sort}}" placeholder="请输入排序编号" autocomplete="off" class="layui-input">

                    </div>

                </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="name">菜单名称</label>

                        <div class="layui-input-block">

                            <input type="text" id="name" name="name" value="{{$adminMenu->name}}" lay-verify="required" placeholder="请输入菜单名称" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item icon">

                        <label class="layui-form-label" for="icon">菜单图标</label>

                        <div class="layui-input-block">

                            <input type="text" id="icon" name="icon" value="{{$adminMenu->icon}}" placeholder="请输入菜单图标" autocomplete="off" class="layui-input">

                            <a href="//www.layui.com/doc/element/icon.html" class="layui-btn layui-btn-danger" target="_blank">选取图标</a>

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="route">操作路由</label>

                        <div class="layui-input-block">

                            <input type="text" id="route" name="route" value="{{$adminMenu->route}}" placeholder="请输入操作路由" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="remark">菜单备注</label>

                        <div class="layui-input-block">

                            <input type="text" id="remark" name="remark" value="{{$adminMenu->remark}}" placeholder="请输入菜单备注" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="status">菜单状态</label>

                        <div class="layui-input-block">

                            <input type="checkbox" id="status" lay-filter="status" @if($adminMenu->status === 1) checked @endif name="status" value="1" lay-skin="switch" lay-text="显示|隐藏">

                        </div>

                    </div>

                    <div class="layui-form-item layui-hide">

                        <button class="layui-btn" lay-submit lay-filter="admin-menus-edit-submit" id="admin-menus-edit-submit">立即提交</button>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>

        layui.extend({

            formSelects : '{/} {{asset('admin/common/formSelects/formSelects-v4')}}',

        }).use(['formSelects', 'common', 'form'], function(){

            const $ = layui.$,
                form = layui.form,
                formSelects = layui.formSelects,
                common = layui.common,
                loader = layui.loader;

            let menuId = $('#id').val(),
                menuParentId = $('#parent-id').val();

            formSelects.data('admin-menus-list', 'server',{
                url:"{{url('menus/classify')}}",
                keyName: 'name',            //自定义返回数据中name的key, 默认 name
                keyVal:  'id',            //自定义返回数据中value的key, 默认 value
                keyChildren: 'all_children',    //联动多选自定义children
                beforeSuccess: function(id, url, searchVal, result){
                    result = result.data;
                    //然后返回数据
                    return result;
                },
                success:function (id, url, searchVal, result) {
                    loader.close(18);
                    //设置默认值
                    formSelects.value('admin-menus-list', [menuParentId], true);
                }
            });

            let flag = false;

            //监听提交
            form.on('submit(admin-menus-edit-submit)', function(data){

                let field = data.field; //获取提交的字段

                let index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

                let url = "{{url('menus/edit')}}/"+menuId;

                if(flag) return false;

                flag = true;

                field.status = field.status ? 1 : 0;

                field.parent_id = field.parent_id ? field.parent_id : 0;

                field.title = '';

                common.ajax(url, 'PUT', field, function (result) {

                    flag = false;

                    if(result.status === 1){

                        common.show('success', result.message, function () {

                            parent.layui.loader.open(18);

                            //渲染表格
                            parent.layui.common.treeTable('#admin-menus-list', '{{url('menus/list')}}');

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




