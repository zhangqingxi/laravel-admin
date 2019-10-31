<!-- 侧边菜单 -->
<div class="layui-side layui-side-menu">

    <div class="layui-side-scroll">

        <div class="layui-logo">

            <span>后台管理</span>

        </div>

        <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">

            <li class="layui-nav-item">

                <a href="{{url('/')}}" lay-tips="主页" lay-direction="2">

                    <i class="layui-icon layui-icon-home"></i>

                    <cite>主页管理</cite>

                </a>

            </li>

            @foreach($adminMenus as $adminMenu)

                @can($adminMenu->route)

                <li class="layui-nav-item">

                    <a href="#" lay-tips="{{$adminMenu->name}}" lay-direction="2">

                        <i class="layui-icon {{$adminMenu->icon}}"></i>

                        <cite>{{$adminMenu->name}}</cite>

                    </a>

                    @if($adminMenu->children->count() !== 0)

                    <dl class="layui-nav-child">

                        @foreach($adminMenu->children as $childMenu)

                        @can($childMenu->route)

                        <dd class="layui-nav-itemed">

                            <a lay-href="{{$childMenu->route}}">{{$childMenu->name}}</a>

                        </dd>

                        @endcan

                        @endforeach

                    </dl>

                    @endif

                </li>

                @endcan

            @endforeach

        </ul>

    </div>

</div>
<!-- 侧边菜单 -->