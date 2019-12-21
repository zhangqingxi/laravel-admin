@extends('admin.layout.main', ['autoload' => 2])

@section('content')

    <div class="layui-fluid" id="admin-roles-permission">

        <div class="layui-card">

            <div class="layui-card-body" pad15>

                <div class="layui-form">

                    <input type="hidden" id="id" value="{{$adminRole->id}}"/>

                    <div class="eleTree admin-roles-permission-list" lay-filter="admin-roles-permission-list"></div>

                    <div class="layui-form-item layui-hide">

                        <button class="layui-btn" lay-submit lay-filter="admin-roles-permission-submit" id="admin-roles-permission-submit">立即提交</button>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>

        layui.extend({

            eleTree : '{/} {{asset('admin/common/eleTree/js/eleTree')}}',

        }).use(['form', 'common', 'eleTree'], function(){

            const $ = layui.$,
                form = layui.form,
                common = layui.common,
                eleTree = layui.eleTree,
                loader = layui.loader;

            let roleId = $('#admin-roles-permission #id').val(),
                adminRolePermissions = "{{$adminRolePermissions}}";

            //渲染树形
            let e1 = eleTree.render({
                elem:'.admin-roles-permission-list',
                emptText:"暂无数据",        // 内容为空的时候展示的文本
                renderAfterExpand: false,    // 是否在第一次展开某个树节点后才渲染其子节点
                highlightCurrent: true,    // 是否高亮当前选中节点，默认值是 false。
                defaultExpandAll: true,    // 是否默认展开所有节点
                expandOnClickNode: true,    // 是否在点击节点的时候展开或者收缩节点， 默认值为 true，如果为 false，则只有点箭头图标的时候才会展开或者收缩节点。
                checkOnClickNode: false,    // 是否在点击节点的时候选中节点，默认值为 false，即只有在点击复选框时才会选中节点。
                defaultExpandedKeys: [],    // 默认展开的节点的 key 的数组
                autoExpandParent: true,     // 展开子节点的时候是否自动展开父节点
                showCheckbox: true,        // 节点是否可被选择
                checkStrictly: true,       // 在显示复选框的情况下，是否严格的遵循父子不互相关联的做法，默认为 false
                defaultCheckedKeys: [],     // 默认勾选的节点的 key 的数组
                accordion: false,           // 是否每次只打开一个同级树节点展开（手风琴效果）
                indent: 20,                 // 相邻级节点间的水平缩进，单位为像素
                lazy: false,                // 是否懒加载子节点，需与 load 方法结合使用
                load: function() {},        // 加载子树数据的方法，仅当 lazy 属性为true 时生效
                draggable: false,           // 是否开启拖拽节点功能
                contextmenuList: [],        // 启用右键菜单，支持的操作有："copy","add","edit","remove"
                method: "get",              // 接口http请求类型，默认：get
                url:"{{url('menus/classify')}}",// 异步数据接口
                contentType: "",                // 发送到服务端的内容编码类型
                headers: {},                    // 接口的请求头。如：headers: {token: ''}
                done: function (res) {             // 数据请求完成的回调函数，只有异步请求才会有
                    adminRolePermissions = adminRolePermissions ? JSON.parse( adminRolePermissions ) : [];
                    e1.setChecked(adminRolePermissions);
                    loader.close(18);
                },
                response: {                     // 对于后台数据重新定义名字
                    statusName: "status",
                    statusCode: 1,
                    dataName: "data"
                },
                request: {                      // 对后台返回的数据格式重新定义
                    name: "name",
                    key: "id",
                    children: "all_children",
                    checked: "checked",
                    disabled: "disabled",
                    isLeaf: "isLeaf"
                },
            });

            let flag = false;
            //监听提交
            form.on('submit(admin-roles-permission-submit)', function(data){

                let checkedItems = e1.getChecked(false, true);

                let ids = [];

                $.each(checkedItems, function (k, v) {

                    ids.push(v.id);

                });

                if(ids.length === 0){

                    common.show('warning', '请选择要设置的权限');

                    return;

                }

                let index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

                let url = "{{url('roles/permission')}}"+'/'+roleId;

                if(flag) return false;

                flag = true;

                common.ajax(url, 'POST', {ids:ids}, function (result) {

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




