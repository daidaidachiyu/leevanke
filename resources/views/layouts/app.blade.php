<!doctype html>
<html class="x-admin-sm">
@include('layouts.head')
<body class="index">
<!-- 顶部开始 -->
<div class="container">
    <div class="logo">
        <a href="/">leevanke</a></div>
    <div class="left_open">
        <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
    </div>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">{{ Auth::user()->name }}</a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                {{--                    <a onclick="xadmin.open('个人信息','http://www.baidu.com')">个人信息</a></dd>--}}
                <dd>
                    <a class="dropdown-item" id="logout" href="#"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        退出登录</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </dd>
            </dl>
        </li>
    </ul>
</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <?php
                echo getMenu();
            ?>
        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content" id="mainbody">
    @yield('content')
</div>
<div class="page-content-bg"></div>
<style id="theme_style"></style>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->


{{--<script>--}}
{{--    function display(url){--}}
{{--        $.ajax({--}}
{{--            type: "get",--}}
{{--            url: url,--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}

</body>

</html>
