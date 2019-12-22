layui.extend({

    loader: '{/}' + ROOT_COMMON_URL + 'loader/js/loader',

    message: '{/}' + ROOT_COMMON_URL + 'message/js/message'

}).define(['jquery', 'loader', 'message'],function(exports){

    let $ = layui.$,
        loader = layui.loader,
        message = layui.message;

    let obj = {
        // 0（信息框，默认）1（页面层）2（iframe层）3（加载层）4（tips层）
        openPage:function(title, content, area, cancelCallBack, yesCallBack){
            layer.open({
                type:1,
                title:title,
                offset: 'auto',
                content: content,
                area: area,
                skin: 'layui-layer-molv',
                cancel: function (index, layero) {
                    cancelCallBack ? cancelCallBack(index, layero) : '';
                },
                yes:function (index, layero) {
                    yesCallBack ? yesCallBack(index, layero) : '';
                }
            });
        },
        openIframe:function(title, content, area, btn, cancelCallBack, yesCallBack){
            layer.open({
                type:2,
                title:title,
                content: content,
                area: area,
                btn:btn,
                skin: 'layui-layer-molv',
                cancel: function (index, layero) {
                    cancelCallBack(index, layero);
                },
                yes:function (index, layero) {
                    yesCallBack(index, layero);
                }
            });
        },
        ajax:function (url, type, data, successCallback, errorCallback) {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:url,
                method:type,
                dataType:'json',
                contentType : "application/json; charset=utf-8",
                data :JSON.stringify(data) ,
                beforeSend:function(){
                  loader.open(17);
                },
                complete:function(){
                    loader.close(17);
                },
                success:function (result) {
                    successCallback(result);
                },
                error:function (e) {
                    errorCallback(e);
                }
            })
        },
        show:function (type = 'success', msg = '执行操作成功', closeCallBack) {

            let parameters = {type:type, message:msg};

            if(closeCallBack){

                parameters['onClose'] = closeCallBack;

            }

            message.show(parameters)

        },
        //无限极分类表格
        treeTable:function (elem, url) {

            let treeTable = layui.treeTable;

            treeTable.render({
                treeColIndex: 1,//树形图标显示在第几列
                treeSpid: 0,//最上级的父级id
                treeIdName: 'id',//id字段的名称
                treePidName: 'parent_id',//pid字段的名称
                treeDefaultClose: true,//是否默认折叠
                treeLinkage: false,//父级展开时是否自动展开所有子级
                elem: elem,
                url: url,
                page: false,
                loading:true,
                cellMinWidth: 120,
                cols: [[
                    {field: 'sort', title: '排序',width:120},
                    {field: 'name', title: '菜单名称'},
                    {field: 'remark', title: '菜单备注'},
                    {field: 'route', title: '操作路由'},
                    {field: 'status', title: '状态', toolbar: '#item-status'},
                    {fixed: 'right', align:'center', title: '操作',  toolbar: '#item-operation'},
                ]],
                done: function (res) {
                    loader.close(18);
                }

            });

        },
        //图片动画样式
        addImageAnimationStyle:function () {

            layui.link(ROOT_COMMON_URL+'imageAnimation/css/imageAnimation.css');

        }

    };

    $('.logout').unbind('click').on('click', function () {
        location.href = $(this).attr('data-url');
    });

    exports('common',obj);

});

