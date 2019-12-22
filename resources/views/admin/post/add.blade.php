@extends('admin.layout.main', ['autoload' => 1])

@section('content')

    <div class="layui-fluid" id="admin-posts-add">

        <div class="layui-card">

            <div class="layui-card-body" pad15>

                <div class="layui-form">

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="title">文章标题</label>

                        <div class="layui-input-block">

                            <input type="text" name="title" id="title" lay-verify="required" placeholder="请输入文章标题" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="description">文章简介</label>

                        <div class="layui-input-block">

                            <input type="text" name="description" id="description" lay-verify="required" placeholder="请输入文章简介" autocomplete="off" class="layui-input">

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="tags">文章标签</label>

                        <div class="layui-input-block">

                            <select name="tags" id="tags" xm-select="selectId" xm-select-search>

                            </select>

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label">文章头图</label>

                        <div class="layui-input-block">

                            <div class="image">

                                <!--图片loading-->
                                <div class="upload-image-loading item-hide">

                                    <div class="loader loader-2">

                                        <svg class="loader-star">

                                            <polygon points="29.8 0.3 22.8 21.8 0 21.8 18.5 35.2 11.5 56.7 29.8 43.4 48.2 56.7 41.2 35.1 59.6 21.8 36.8 21.8 " fill="#18ffff"></polygon>

                                        </svg>

                                        <div class="loader-circles"></div>

                                    </div>

                                </div>

                                <!--图片上传控件-->
                                <div class="layui-upload-drag" id="upload-image-drag">

                                    <i class="layui-icon"></i>

                                    <p>点击上传，或将文件拖拽到此处</p>

                                </div>

                                <!--图片-->
                                <div class="image-box item-hide">

                                    <img alt="" src=""/>

                                    <input type="hidden" lay-verify="image" name="image" value=""/>

                                    <div class="box-content">

                                        <div class="inner-content">

                                            <span class="btn">删除</span>

                                            <span class="btn">预览</span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="content">文章内容</label>

                        <div class="layui-input-block ue_content">

                            @include('vendor.UEditor.head')

                            <textarea id="content" name="content" style="width: 80%;z-index: 0;"></textarea>

                        </div>

                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label" for="status">发布状态</label>

                        <div class="layui-input-block">

                            <input type="checkbox" lay-verify="required" id="status" name="status" lay-skin="switch" lay-text="已发布|待发布">

                        </div>

                    </div>

                    <div class="layui-form-item layui-hide">

                        <button class="layui-btn" lay-submit lay-filter="admin-posts-add-submit" id="admin-posts-add-submit">立即提交</button>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>

        layui.extend({

            formSelects : '{/} {{asset('static/common/formSelects/formSelects-v4')}}',

        }).use(['formSelects', 'form', 'common', 'upload'], function(){

            const $ = layui.$,
                form = layui.form,
                formSelects = layui.formSelects,
                common = layui.common,
                upload = layui.upload,
                loader = layui.loader;

            {{--formSelects.data('admin-posts-list', 'server',{--}}
            {{--    url:"{{url('menus/classify')}}",--}}
            {{--    keyName: 'name',            //自定义返回数据中name的key, 默认 name--}}
            {{--    keyVal:  'id',            //自定义返回数据中value的key, 默认 value--}}
            {{--    keyChildren: 'all_children',    //联动多选自定义children--}}
            {{--    beforeSuccess: function(id, url, searchVal, result){--}}
            {{--        result = result.data;--}}
            {{--        //然后返回数据--}}
            {{--        return result;--}}
            {{--    },--}}
            {{--    success:function () {--}}
            {{--        //设置默认值--}}
            {{--        formSelects.value('admin-menus-list', [menuId], true);--}}
            {{--    }--}}
            {{--});--}}

            //引入图片动画样式
            common.addImageAnimationStyle();

            //拖拽上传
            upload.render({
                elem: '#admin-posts-add #upload-image-drag',//指向容器选择器
                url: '{{url("posts/upload")}}',//服务端上传接口
                method:'post',
                data:{_token: '{{csrf_token()}}'},
                auto: true ,//是否选完文件后自动上传
                field:'file',//文件域的字段名
                multiple:false,//是否允许多文件上传
                accept: 'images', //指定允许上传时校验的文件类型，可选值有：images（图片）、file（所有文件）、video（视频）、audio（音频）
                acceptMime: 'image/*', //规定打开文件选择框时，筛选出的文件类型
                size:0,//设置文件最大可允许上传的大小 ，单位 KB  0 ==> 不限制
                drag:true,//是否接受拖拽的文件上传，设置 false 可禁用
                before:function(obj){
                    $('#admin-posts-add .image .layui-upload-drag').addClass('item-hide');
                    $('#admin-posts-add .image .image-box input[type=hidden]').val('');
                    $('#admin-posts-add .image .upload-image-loading').removeClass('item-hide');
                },
                choose: function (obj) {
                    //预读本地文件示例，不支持ie8
                    obj.preview(function (index, file, result) {
                        $('#admin-posts-add .image .image-box').removeClass('item-hide').find('img').attr('src', result); //图片链接（base64）
                    });
                },
                done: function (res) {

                    $('#admin-posts-add .image .upload-image-loading').addClass('item-hide');

                    if(res.status !== 1) {

                        common.show('warning', '图片上传失败', function () {

                            $('#admin-posts-add .image img').attr('src', '');

                            $('#admin-posts-add .image .layui-upload-drag').removeClass('item-hide');

                        });

                    }else{

                        common.show('success', '图片上传成功', function () {

                            $('#admin-posts-add .image .image-box input[type=hidden]').val(res.data.url);

                            //删除|预览图片
                            $('#admin-posts-add .image .image-box .btn').on('click', function () {

                                active.image($(this).text(), res.data.url)

                            });

                        });

                    }
                },
                error:function (index, upload, obj) {

                    common.show('error', '图片上传异常', function () {

                        $('#admin-posts-add .image .upload-image-loading').addClass('item-hide');

                        $('#admin-posts-add .image img').attr('src', '');

                        $('#admin-posts-add .image .layui-upload-drag').removeClass('item-hide');

                    });

                }

            });

            let active = {
                //图片预览或删除
                image:function(title, url){
                    if(title === '删除'){
                        $('#admin-posts-add .image .image-box img').attr('src', '');
                        $('#admin-posts-add .image .image-box input[type=hidden]').val('');
                        $('#admin-posts-add .image .layui-upload-drag').removeClass('item-hide');
                    }else{
                        const content =  "<img width='100%' height='100%' src='"+url+"' alt=''/>"; //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                        common.openPage('', content, ['70%', '50%'])
                    }
                },
                ueReady:function (height) {
                    ue.ready(function() {
                        ue.setHeight(height);
                        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                    });
                }
            };

            //editor编辑器
            const ue = UE.getEditor('content');

            active.ueReady(350);

            let flag = false;
            //监听提交
            form.on('submit(admin-posts-add-submit)', function(data){

                let field = data.field; //获取提交的字段

                field.content = ue.getContent();

                field.status = field.status ? 1 : 0;

                let index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

                let url = "{{url('posts/add')}}";

                if(flag) return false;

                flag = true;

                common.ajax(url, 'POST', field, function (result) {

                    flag = false;

                    if(result.status === 1){

                        common.show('success', result.message, function () {

                            parent.layui.loader.open(18);

                            //渲染表格
                            parent.layui.table.reload('admin-posts-list');

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
