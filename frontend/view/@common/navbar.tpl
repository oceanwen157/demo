<!-- 公共部分/头部导航 -->
<div id="header" class="header">
    <div class="flyout-overlay"></div>
    
    <!-- 搜索设置 start -->
    <div class="header-container container relative flex py-4 px-3 mobile:py-3 mobile:px-2 gap-2 items-center justify-between flex-wrap">

        <!-- logo start -->
        <div class="flex gap-2 justify-start items-center mobile:basis-[65%]">
            <button type="button" class="button button-text desktop:hidden" data-flyout="toggle" data-target="navigation">
                <i class="icon-start far fa-bars"></i>
            </button>
            <a class="logo-container desktop-site-logo" aria-label="Homepage link" href="/" title="Free Porn Videos // Qorno">
                <img class="logo logo-default logo-dark" src="__ROOT_PATH__/__base/images/logo.png" alt="Free Porn Videos // Qorno">
                <img class="logo logo-light" src="__ROOT_PATH__/__base/images/logo.png" alt="Free Porn Videos // Qorno">
            </a>
        </div>
        <!-- logo end -->

        <!-- 搜索 start -->
        {include file="@common/search" /}
        <!-- 搜索 end -->

        <!-- 设置 start -->
        <div class="settings-wrapper flex items-center gap-1 settings-hook">
            <!-- 多语言 start -->
            <button type="button" class="button button-text" title="Orientation" data-settings="Orientation" aria-haspopup="true" aria-expanded="false" data-dropdown-placement="bottom-end">
                <i class="fa-solid fa-earth-americas"></i>
            </button>
            <div class="dropdown-menu w-[250px] site-orientation-menu" aria-labelledby="dropdown orientation">
                <div class="panel-wrapper">
                    <div class="panel-container">
                        <div class="main-panel panel">
                            <div class="orientation-panel panel" data-setting="orientation">
                                <div class="panel-content">
                                    <div class="tag-data" data-tag-name="orientation" data-persistent="0">
                                        {foreach name="__LANGUAGES__" item="e" key="i" }
                                            <a href="/lang/switch?lang={$e.tag}" data-tag-value="straight" class="menu-item px-5 flex items-center gap-3 selected" data-label="Straight">
                                                <i class="far flex-shrink-0 w-4 fa-check opacity-0 {if $currentLang == trim($e->tag)}opacity-100{else}opacity-0{/if}"></i>{$e->title}
                                            </a>
                                        {/foreach}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 多语言 end -->

            <!-- 性取向 start -->
            <!-- 
            <button type="button" class="button button-text" title="Orientation" data-settings="Orientation" aria-haspopup="true" aria-expanded="false" data-dropdown-placement="bottom-end">
                <i class="icon-start far fa-venus-mars"></i>
            </button>
            <div class="dropdown-menu w-[250px] site-orientation-menu" aria-labelledby="dropdown orientation">
                <div class="panel-wrapper">
                    <div class="panel-container">
                        <div class="main-panel panel">
                            <div class="orientation-panel panel" data-setting="orientation">
                                <div class="panel-content">
                                    <div class="tag-data" data-tag-name="orientation" data-persistent="0">
                                        <a href="/home/主题#Straight" data-tag-value="straight" class="menu-item px-5 flex items-center gap-3 selected" data-label="Straight">
                                            <i class="far flex-shrink-0 w-4 fa-check opacity-0 opacity-100"></i>Straight
                                        </a>
                                        <a href="/home/主题#Gay" data-tag-value="gay" class="menu-item px-5 flex items-center gap-3 " data-label="Gay">
                                            <i class="far flex-shrink-0 w-4 fa-check opacity-0 "></i>Gay
                                        </a>
                                        <a href="/home/主题#Trans" data-tag-value="shemale" class="menu-item px-5 flex items-center gap-3 " data-label="Trans">
                                            <i class="far flex-shrink-0 w-4 fa-check opacity-0 "></i>Trans
                                        </a>
                                        <a href="/home/主题#StraightGay" data-tag-value="straight-and-gay" class="menu-item px-5 flex items-center gap-3 " data-label="Straight &amp; Gay">
                                            <i class="far flex-shrink-0 w-4 fa-check opacity-0 "></i>Straight &amp; Gay
                                        </a>
                                        <a href="/home/主题#StraightTrans" data-tag-value="straight-and-shemale" class="menu-item px-5 flex items-center gap-3 " data-label="Straight &amp; Trans">
                                            <i class="far flex-shrink-0 w-4 fa-check opacity-0 "></i>Straight &amp; Trans
                                        </a>
                                        <a href="/home/主题#GayTrans" data-tag-value="gay-and-shemale" class="menu-item px-5 flex items-center gap-3 " data-label="Gay &amp; Trans">
                                            <i class="far flex-shrink-0 w-4 fa-check opacity-0 "></i>Gay &amp; Trans
                                        </a>
                                        <a href="/home/主题#All" data-tag-value="straight-and-gay-and-shemale" class="menu-item px-5 flex items-center gap-3 " data-label="All">
                                            <i class="far flex-shrink-0 w-4 fa-check opacity-0 "></i>All
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            -->
            <!-- 性取向 end -->

            <!-- 结构性 start -->
            <button type="button" class="button button-text" title="Settings" data-settings="Settings" aria-haspopup="true" aria-expanded="false" data-dropdown-placement="bottom-end">
                <i class="icon-start far fa-cogs"></i>
            </button>
            <div class="dropdown-menu w-[250px] site-settings-menu" aria-labelledby="dropdown settings">
                <div class="panel-wrapper">
                    <div class="panel-container">
                        <div class="main-panel panel">
                            <button class="panel-button panel-next" data-panel-target="pricing-panel">
                                <i class="far fa-dollar icon-start"></i>
                                <span class="flex justify-between items-center w-full">
                                    <span class="flex flex-col text-left rtl:text-right">
                                        收费<span class="setting-text">免费 &amp; 收费</span>
                                    </span>
                                    <i class="far fa-chevron-right icon-end"></i>
                                </span>
                            </button>

                            <button class="panel-button panel-next width-toggle">
                                <i class="far fa-grid-2 icon-start"></i>
                                <span class="flex justify-between items-center w-full">
                                    <span class="flex flex-col text-left rtl:text-right">
                                        列表缩放
                                        <span class="opacity-50 text-sm font-normal">
                                            <span class="toggle-on-label hidden">开</span>
                                            <span class="toggle-off-label">关</span>
                                        </span>
                                    </span>
                                    <span class="toggle flex pointer-events-none">
                                        <input type="checkbox" id="thumbnail-size-toggle" class="hidden">
                                        <label for="thumbnail-size-toggle" class="toggle-label">
                                            <i class="icon far fa-check"></i>
                                        </label>
                                    </span>
                                </span>
                            </button>

                            <hr class="divider-horizontal">

                            <a href="/help/常见问题" class="button button-text navigation-button" aria-label="FAQ">
                                <i class="icon-start far fa-info-circle"></i>
                                <span class="flex justify-between items-center w-full">帮助说明</span>
                            </a>

                            <a href="/help/联系我们" class="button button-text navigation-button" aria-label="Contact">
                                <i class="icon-start far fa-comment"></i>
                                <span class="flex justify-between items-center w-full">联系我们</span>
                            </a>
                        </div>
                        <div class="stacked-panels">
                            <div class="dummy-panel panel"></div>
                            <div class="pricing-panel panel" data-setting="pricing">
                                <div class="flyout-menu-header">
                                    <button type="button" class="button button-text panel-previous flex-shrink-0" aria-label="Menu arrow-left">
                                        <i class="icon-start far fa-arrow-left"></i>
                                    </button>
                                    <div class="flex-grow text-lg desktop:text-base desktop:font-medium">Pricing</div>
                                    <div class="flex size-9 items-center justify-center text-lg"></div>
                                </div>
                                <hr class="divider-horizontal">
                                <div class="panel-content tag-filter">
                                    <div class="tag-data" data-tag-name="pricing" data-persistent="1">
                                        <a href="/" data-tag-value="free-and-membership-and-payperview-and-payperclip-and-fansubscription" class="menu-item px-5 flex items-center gap-3 selected" data-label="Free &amp; Premium">
                                            <i class="far flex-shrink-0 w-4 fa-check opacity-0 opacity-100"></i>Free &amp; Premium
                                        </a>
                                        <a href="/" data-tag-value="membership-and-payperview-and-payperclip-and-fansubscription" class="menu-item px-5 flex items-center gap-3 " data-label="Premium only">
                                            <i class="far flex-shrink-0 w-4 fa-check opacity-0 "></i>Premium only
                                        </a>
                                        <a href="/" data-tag-value="free" class="menu-item px-5 flex items-center gap-3 " data-label="Free only">
                                            <i class="far flex-shrink-0 w-4 fa-check opacity-0 "></i>Free only
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 结构性 end -->
        </div>
        <!-- 设置 end -->
    </div>
    <!-- 搜索设置 end-->

    <!-- 头部导航 start -->
    <nav class="desktop-navigation flex gap-4 mobile:hidden">
        <div class="container flex">
            <div class="dropdown">
                <a data-toggle="dropdown" class="anchor-link menu-item focus-visible:outline-0" href="#" aria-haspopup="true" aria-expanded="false">
                    {$Think.lang.videos}<i class="icon-end far fa-chevron-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="all-videos">
                    <a class="anchor-link menu-item px-3 popular" href="/popular" target="_self">
                        {$Think.lang.popularVideos}
                    </a>
                    <a class="anchor-link menu-item px-3 new" href="/new" target="_self">
                        {$Think.lang.newVideos}New videos
                    </a>
                    <a class="anchor-link menu-item px-3 rating" href="/rating" target="_self">
                        {$Think.lang.topRatedVideos}Top rated videos
                    </a>
                </div>
            </div>
            <div class="dropdown">
                <a data-toggle="dropdown" class="anchor-link menu-item focus-visible:outline-0" href="#"
                    aria-haspopup="true" aria-expanded="false">
                    {$Think.lang.categories}<i class="icon-end far fa-chevron-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="all-categories">
                    {foreach name="__CATEGORIES__" item="e" key="i" }
                        <a class="anchor-link menu-item px-3 whitespace-nowrap" href="{$e->route_ori}">
                            {$e->title_en}<span class="badge badge-text badge-xsm">{$e->quantity_desc}</span>
                        </a>
                    {/foreach}
                    <a href="/a-z" class="button button-secondary flex mx-2" target="_self">
                        {$Think.lang.allCategories}
                    </a>
                </div>
            </div>
            <div class="dropdown">
                <a data-toggle="dropdown" class="anchor-link menu-item focus-visible:outline-0" href="#" aria-haspopup="true" aria-expanded="false">
                    {$Think.lang.pornstars}<i class="icon-end far fa-chevron-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="all-categories">
                    {foreach name="__PORNSTARS__" item="e" key="i" }
                        <a class="anchor-link menu-item px-3 whitespace-nowrap" href="{$e->route_ori}">
                            {$e->title_en}
                            <span class="badge badge-text badge-xsm">{$e->quantity_desc}</span>
                        </a>
                    {/foreach}
                    <a href="/pornstar" class="button button-secondary flex mx-2" target="_self">
                        {$Think.lang.allPornstars}
                    </a>
                </div>
            </div>
            <a class="anchor-link menu-item" id="network" href="/network" target="_self">
                {$Think.lang.ourNetwork}
            </a>
        </div>
    </nav>
    <!-- 头部导航 end -->

    <!-- 左侧导航 start -->
    <div id="navigation" class="flyout-menu flyout-navigation" data-flyout="menu">
        <div class="flyout-menu-header">
            <button type="button" class="button button-text flyout-close flex-shrink-0" aria-label="Menu close">
                <i class="icon-start far fa-close"></i>
            </button>
            <a class="logo-container" href="/" title="Free Porn Videos // Qorno">
                <img class="logo logo-default logo-dark" src="__ROOT_PATH__/__base/images/logo.png" alt="Free Porn Videos // Qorno">
            </a>
            <div class="flex size-9 items-center justify-center text-lg"></div>
        </div>

        <hr class="divider-horizontal">

        <section class="accordion">
            <button class="accordion-button active" data-default-open="">
                <i class="far fa-video-camera icon-start"></i>
                <span class="label-container">
                    <span class="label">视频</span>
                    <i class="far fa-chevron-down"></i>
                </span>
            </button>
            <div class="accordion-menu open">
                <div class="overflow-hidden">
                    <a class="anchor-link menu-item px-3 popular" href="/popular" target="_self">热门视频</a>
                    <a class="anchor-link menu-item px-3 new" href="/new" target="_self">最新视频</a>
                    <a class="anchor-link menu-item px-3 rating" href="/rating" target="_self">高分视频</a>
                </div>
            </div>
        </section>
        <section class="accordion">
            <button class="accordion-button">
                <i class="far fa-folder-tree icon-start"></i>
                <span class="label-container">
                    <span class="label">分类</span>
                    <i class="far fa-chevron-down"></i>
                </span>
            </button>
            <div class="accordion-menu">
                <div class="overflow-hidden">
                    {foreach name="__LISTS__" item="e" key="i" }
                        {if $i < 6}
                            <a class="anchor-link menu-item px-3 whitespace-nowrap" href="/testssxx#cum-inside">
                                <span class="menu-pill">{$e.username}</span>
                                <span class="badge badge-text badge-xsm">{$e.view}M</span>
                            </a>
                        {/if}
                    {/foreach}
                    <a href="/a-z" class="button button-secondary flex mx-2" target="_self">
                        全部分类
                    </a>
                </div>
            </div>
        </section>
        <section class="accordion">
            <button class="accordion-button">
                <i class="far fa-star icon-start"></i>
                <span class="label-container">
                    <span class="label">明星</span>
                    <i class="far fa-chevron-down"></i>
                </span>
            </button>
            <div class="accordion-menu">
                <div class="overflow-hidden">
                    {foreach name="__LISTS__" item="e" key="i" }
                        {if $i < 6}
                            <a class="anchor-link menu-item px-3 whitespace-nowrap" href="/home/明星#/angela-white">
                                <span class="menu-pill">{$e.username}</span>
                                <span class="badge badge-text badge-xsm">{$e.view}K</span>
                            </a>
                        {/if}
                    {/foreach}
                    <a href="/home/明星#" class="button button-secondary flex mx-2" target="_self">
                        全部明星321
                    </a>
                </div>
            </div>
        </section>
        <a href="/cooperate/合作列表" class="button button-text navigation-button" id="network" target="_self">
            <i class="icon-start far fa-globe-americas"></i>
            <span class="flex justify-between items-center w-full">
                合作伙伴
            </span>
        </a>
    </div>
    <!-- 左侧导航 end -->
</div>