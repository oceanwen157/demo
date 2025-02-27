<!-- 公共部分/左侧导航 -->

<div id="popup-menu" class="hide">
    <div class="is-mobile">
        <div class="van-overlay" @click="onMenuClose"></div>
        <div role="dialog" id="van-popup-menu" tabindex="0" class="van-popup van-popup--left">
            <div class="header">
                <a href="/" class="left">
                    <div class="popup-logo"><div class="xqbj-icon-logo"></div></div>
                    <div class="van-nav-bar__left_area">
                        <span class="van-nav-bar__left_top">海角网</span>
                        <span class="van-nav-bar__left_bottom">千万原创资源免费观看</span>
                    </div>
                </a>
                <div class="right">
                    <div class="img" @click="onMenuClose">
                        <img src="__ROOT_PATH__/__base/images/close-blue.png" class="close-left-menu-btn">
                    </div>
                </div>
            </div>
            <div class="content hasscrollbar nav-slider new-nav" id="navbar">
                 <!-- navbar组件 start -->
                 {include file="@components/xqbj-component-navbar0111" /}
                 <!-- navbar组件 end -->
            </div>
            <div class="footer"></div>
        </div>
    </div>
</div>