<!DOCTYPE html>
<html theme='light'>
    <!-- 页面头部 start -->
    {include file="@common/header" /}
    <!-- 页面头部 end -->

    <!-- 主体内容 start -->
    <body>
        <!--  -->
        <div id="xqbj-container">

            <!-- 头部导航 start -->
            <div class="xqbj-header">
                {include file="@common/navbar" /}
            </div>
            <!-- 头部导航 end -->

            <!-- 页面内容 start -->
            <div class="xqbj-main">
                <!-- 左侧导航(内) start -->
                <div class="xqbj-main-container-left">
                    {include file="@common/naviga2" /}
                </div>
                <!-- 左侧导航(内) end -->
                <div class="xqbj-main-container">
                    {__CONTENT__}
                </div>
                <div class="xqbj-main-container-right">
                    
                </div>
            </div>
            <!-- 页面内容 end -->

            <!-- 底部菜单 start -->
            <div class="xqbj-footer">
                {include file="@common/tabber" /}
            </div>
            <!-- 底部菜单 end -->
        </div>

        <!-- 左侧导航 start -->
        {include file="@common/naviga3" /}
        <!-- 左侧导航 end -->
    </body>
    <!-- 主体内容 start -->

    <!-- 页面底部 start -->
    {include file="@common/footer" /}
    <!-- 页面底部 end -->
     
</html>