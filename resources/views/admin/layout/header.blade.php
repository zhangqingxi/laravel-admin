<!-- 头部区域 -->
<div class="layui-header">

    <ul class="layui-nav layui-layout-left">
        <li class="layui-nav-item layadmin-flexible" lay-unselect>

            <a href="#" layadmin-event="flexible" title="侧边伸缩">

                <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>

            </a>

        </li>

        <li class="layui-nav-item layui-hide-xs" lay-unselect>

            <a href="{{url('/')}}" target="_blank" title="前台">

                <i class="layui-icon layui-icon-website"></i>

            </a>

        </li>

        <li class="layui-nav-item" lay-unselect>

            <a href="javascript:;" layadmin-event="refresh" title="刷新">

                <i class="layui-icon layui-icon-refresh-3"></i>

            </a>

        </li>

    </ul>

    <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right" style="margin-right: 1%;">

        <li class="layui-nav-item layui-hide-xs" lay-unselect>

            <a href="javascript:;" layadmin-event="theme">

                <i class="layui-icon layui-icon-theme"></i>

            </a>

        </li>

        <li class="layui-nav-item layui-hide-xs" lay-unselect>

            <a href="javascript:;" layadmin-event="fullscreen">

                <i class="layui-icon layui-icon-screen-full"></i>

            </a>

        </li>

        <li class="layui-nav-item" lay-unselect>

            <a href="#">

                <cite>{{$adminUser->username}}</cite>

            </a>

            <dl class="layui-nav-child">

                <dd><a lay-href="set/user/info.html">基本资料</a></dd>

                <dd><a lay-href="set/user/password.html">修改密码</a></dd>

                <dd class="logout" data-url="{{url('logout')}}" style="cursor: pointer"><a>退出登录</a></dd>

            </dl>

        </li>

    </ul>

</div>
<!-- 头部区域 -->