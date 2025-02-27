<!DOCTYPE html>
<html class='dark' lang="en">

<!-- 页面头部 start -->
{include file="@common/header" /}
<!-- 页面头部 end -->

<!-- 主体内容 start -->
<body class="text-[var(--text-color)] main-page">
    <div id="main" class="min-h-screen mobile:pt-[107px] flex flex-col">
        <div id="xqbj-container" class="content-container flex flex-col flex-grow">

            <!-- 头部导航 start -->
            <div class="xqbj-header">
                {include file="@common/navbar" /}
            </div>
            <!-- 头部导航 end -->

            <!-- 页面内容 start -->
            <div class="xqbj-main">
                {__CONTENT__}
            </div>
            <!-- 页面内容 end -->
            
        </div>

        <!-- 底部菜单 start -->
        <div class="xqbj-footer">
            {include file="@common/tabber" /}
        </div>
        <!-- 底部菜单 end -->
    </div>

    <!-- 置顶 start -->
    {include file="@common/sticky" /}
    <!-- 置顶 end -->

    <!-- 警告 start -->
    {include file="@common/prevent" /}
    <!-- 警告 end -->

</body>
<!-- 主体内容 start -->

<!-- 页面底部 start -->
{include file="@common/footer" /}
<!-- 页面底部 end -->

</html>