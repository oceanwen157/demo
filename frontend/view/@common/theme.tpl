<!-- 公共部分/头部导航 -->

<div class="is-mobile van-nav-bar van-nav-bar--fixed van-hairline--bottom">
    <div class="van-nav-bar__content">
        <div class="van-nav-bar__left van-haptics-feedback backbtn">
            <div class="xqbj-icon-back"></div>
        </div>
        <div class="van-nav-bar__title van-ellipsis nav-bar-title">
            当前分类
        </div>
        <div class="van-nav-bar__right van-haptics-feedback">
            <div class="xqbj-btn background search search-btn">
                <a href="/home/历史" class="xqbj-icon-search"></a>
                <!-- 搜索 start -->
                <!-- 
                <div class="container-search">
                    <div class="container-search-context">
                        <div class="container-search-context-louyat">
                            <div class="container-search-context-input">
                                <input type="text" class="input-control" id="input-mobile-control-key" placeholder="开启精彩搜索">
                                <div class="input-search-btn input-mobile-search-btn">
                                    <div class="xqbj-icon-search2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="container-search-context-title">热门搜索</div>
                        <div class="container-search-context-tags">
                            {foreach name="__LISTS__" item="e" key="i" }
                                <a href="/" class="container-search-context-tags-item">{$e.tag2}</a>
                            {/foreach} 
                        </div>
                    </div>
                </div> 
                -->
                <!-- 搜索 end -->
            </div>

            <!-- menbnu start -->
            <div class="xqbj-btn menu_btn">
                <div class="xqbj-icon-menu"></div>
            </div>
            <!-- menbnu end -->
        </div>
    </div>
</div>

<nav class="is-desktop navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <div class="menubtn"><div class="xqbj-icon-logo"></div></div>
            <span class="van-nav-bar__left_area">
                <span class="van-nav-bar__left_top">海角网</span>
                <span class="van-nav-bar__left_bottom">千万原创资源免费观看</span>
            </span>
        </a>
        <div class="collapse navbar-collapse">
            <div class="navbar-nav-right">
                <div class="search search-btn">
                    <div class="xqbj-icon-search"></div>
                    <input autocomplete="off" type="text" id="input-desktop-control-key" class="input-control " placeholder="搜帖/搜人/搜标签">
                    <div class="btn-search input-desktop-control-readonly-key">搜索</div>
                    <!-- 搜索 start -->
                    <div class="container-search container-search-desktop hide">
                        <div class="container-search-context">
                          <!-- 搜索组件 start -->
                          {include file="@components/xqbj-component-search" /}
                          <!-- 搜索组件 end -->
                        </div>
                    </div>
                    <!-- 搜索 end -->
                </div>

                <div class="contact-info">
                    <div class="item">
                        <div class="xqbj-icon-tg icon"></div>
                        <a href="###">联系我们</a>
                    </div>
                    <div class="item ushare">
                        <div class="xqbj-icon-share2 icon"></div>
                        <a href="###">分享邀请</a>
                    </div>
                </div>

                <div class="sign hide">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown navmore3">
                            <div class="xqbj-icon-tg dropdown-toggle" href="#" id="navbarDropdownMenuTg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
                            <ul class="dropdown-menu dropdown-menu3 dropdown-menu-more3">
                                {volist name="__LISTS__" id="tag" key="i"}
                                    {if $i < 5}
                                        <li>
                                            <a class="dropdown-item" href="{$tag.url}">{$tag.text}</a>
                                        </li>
                                    {/if}
                                {/volist}
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

</nav>