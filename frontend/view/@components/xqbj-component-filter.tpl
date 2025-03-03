<!-- 通用组件/列表 -->

<div class="content-filter">
    <form name="filter" method="get">

        <!-- 排序 start -->
        <div class="filter-order_by_widget flex justify-between">
            <div class="chip-group mobile:scrollable" id="filter_order_by" name="filter[order_by]"
                data-filter="order_by">
                <div class="chip-group-contents">
                    <label class="chip" for="filter_order_by_0">
                        <span class="label">Popularity</span>
                        <input type="radio" id="filter_order_by_0" name="filter[order_by]" value="popular" required="" checked="" class="hidden">
                    </label>
                    <label class="chip" for="filter_order_by_1">
                        <span class="label">Date</span>
                        <input type="radio" id="filter_order_by_1" name="filter[order_by]" value="date" required="" class="hidden">
                    </label>
                    <label class="chip" for="filter_order_by_2">
                        <span class="label">Duration</span>
                        <input type="radio" id="filter_order_by_2" name="filter[order_by]" value="duration" required="" class="hidden">
                    </label>
                    <label class="chip" for="filter_order_by_3">
                        <span class="label">Rating</span>
                        <input type="radio" id="filter_order_by_3" name="filter[order_by]" value="rating" required="" class="hidden">
                    </label>
                </div>
            </div>
            <button type="button" class="button button-secondary filter-button desktop:hidden flex-shrink-0" title="Filter" data-flyout="toggle" data-target="filter-flyout">
                <i class="icon-start far fa-sliders"></i>Filter
            </button>
        </div>
        <!-- 排序 end -->

        <!-- 过滤 start -->
        <div id="filter-flyout" class="filter filter_container mobile:flyout-menu mobile:flyout-right flyout-filter" data-flyout="menu">
            <div class="flyout-menu-header h-12">
                <div class="flex-grow text-lg px-2">视频筛选</div>
                <button type="button" class="button button-text flyout-close flex-shrink-0" aria-label="Menu close">
                    <i class="icon-start far fa-close"></i>
                </button>
            </div>
            <hr class="divider-horizontal desktop:hidden">
            <div class="filter-button-container flex gap-8 desktop:gap-2 desktop:items-center mobile:overflow-auto desktop:flex-wrap flex-grow mobile:flex-col flyout-content">
                
                <!-- 最近新增 start -->
                <div class="filter-dropdown content-filter-container whitespace-nowrap">
                    <div class="filter-title-container flex justify-between px-3 desktop:hidden">
                        <div class="filter-header-title m-0 font-medium mb-1 text-base">
                            添加日期
                        </div>
                        <span class="filter-reset-advertiser_publish_date content-filter-reset-button mobile:text-[var(--primary-active-text)]">
                            <i class="far fa-times mobile:hidden"></i>
                            <span class="desktop:hidden">reset</span>
                        </span>
                    </div>
                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" data-dropdown-placement="bottom-end" class="chip dropdown-toggle mobile:hidden">
                        <span class="label">Date added</span>
                        <span class="sub-label hidden filter_advertiser_publish_date_header content-filter-header menu-button" data-menu="filter_advertiser_publish_date">
                            添加日期
                        </span>
                        <i class="far icon-end fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu mobile-filter-dropdown-menu filter_advertiser_publish_date_widget content-filter-widget desktop:scrollable-menu" aria-labelledby="dropdown-filter_advertiser_publish_date" data-menu="filter_advertiser_publish_date">
                        <div class="filter-options-partial-options">
                            <div class="radio filter_advertiser_publish_date_setting filter-setting">
                                <input type="radio" id="filter_advertiser_publish_date_0" name="filter[publish_date]" value="all" checked="">
                                <label class="menu-item" for="filter_advertiser_publish_date_0">全部</label>
                            </div>
                            <div class="radio filter_advertiser_publish_date_setting filter-setting">
                                <input type="radio" id="filter_advertiser_publish_date_1" name="filter[publish_date]" value="1D">
                                <label class="menu-item" for="filter_advertiser_publish_date_1">过去 24 小时</label>
                            </div>
                            <div class="radio filter_advertiser_publish_date_setting filter-setting">
                                <input type="radio" id="filter_advertiser_publish_date_2" name="filter[publish_date]" value="2D">
                                <label class="menu-item" for="filter_advertiser_publish_date_2">过去 2 天</label>
                            </div>
                            <div class="radio filter_advertiser_publish_date_setting filter-setting">
                                <input type="radio" id="filter_advertiser_publish_date_3" name="filter[publish_date]" value="7D">
                                <label class="menu-item" for="filter_advertiser_publish_date_3">过去一周</label>
                            </div>
                            <div class="radio filter_advertiser_publish_date_setting filter-setting">
                                <input type="radio" id="filter_advertiser_publish_date_4" name="filter[publish_date]" value="1M">
                                <label class="menu-item" for="filter_advertiser_publish_date_4">过去一月</label>
                            </div>
                            <div class="radio filter_advertiser_publish_date_setting filter-setting">
                                <input type="radio" id="filter_advertiser_publish_date_5" name="filter[publish_date]" value="3M">
                                <label class="menu-item" for="filter_advertiser_publish_date_5">过去 3 个月</label>
                            </div>
                            <div class="radio filter_advertiser_publish_date_setting filter-setting">
                                <input type="radio" id="filter_advertiser_publish_date_6" name="filter[publish_date]" value="1Y">
                                <label class="menu-item" for="filter_advertiser_publish_date_6">去年</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 最近新增 end -->
                
                <!-- 视频时长 start -->
                <div class="filter-dropdown content-filter-container whitespace-nowrap">
                    <div class="filter-title-container flex justify-between px-3 desktop:hidden">
                        <div class="filter-header-title m-0 font-medium mb-1 text-base">
                            Duration
                        </div>
                        <span
                            class="filter-reset-duration content-filter-reset-button mobile:text-[var(--primary-active-text)]">
                            <i class="far fa-times mobile:hidden"></i>
                            <span class="desktop:hidden">reset</span>
                        </span>
                    </div>
                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                        data-dropdown-placement="bottom-end" class="chip dropdown-toggle mobile:hidden">
                        <span class="label">Duration</span>
                        <span class="sub-label hidden filter_duration_header content-filter-header menu-button" data-menu="filter_duration">
                            Duration
                        </span>
                        <i class="far icon-end fa-chevron-down"></i>
                    </button>

                    <div class="dropdown-menu mobile-filter-dropdown-menu filter_duration_widget content-filter-widget desktop:scrollable-menu"
                        aria-labelledby="dropdown-filter_duration" data-menu="filter_duration">
                        <div class="filter-options-partial-options">
                            <div class="radio filter_duration_setting filter-setting">
                                <input type="radio" id="filter_duration_0" name="filter[duration]" value="all" checked="">
                                <label class="menu-item" for="filter_duration_0">All</label>
                            </div>
                            <div class="radio filter_duration_setting filter-setting">
                                <input type="radio" id="filter_duration_1" name="filter[duration]" value="60">
                                <label class="menu-item" for="filter_duration_1">1+ minute</label>
                            </div>
                            <div class="radio filter_duration_setting filter-setting">
                                <input type="radio" id="filter_duration_2" name="filter[duration]" value="300">
                                <label class="menu-item" for="filter_duration_2">5+ minutes</label>
                            </div>
                            <div class="radio filter_duration_setting filter-setting">
                                <input type="radio" id="filter_duration_3" name="filter[duration]" value="600">
                                <label class="menu-item" for="filter_duration_3">10+ minutes</label>
                            </div>
                            <div class="radio filter_duration_setting filter-setting">
                                <input type="radio" id="filter_duration_4" name="filter[duration]" value="1200">
                                <label class="menu-item" for="filter_duration_4">20+ minutes</label>
                            </div>
                            <div class="radio filter_duration_setting filter-setting">
                                <input type="radio" id="filter_duration_5" name="filter[duration]" value="1800">
                                <label class="menu-item" for="filter_duration_5">30+ minutes</label>
                            </div>
                            <div class="radio filter_duration_setting filter-setting">
                                <input type="radio" id="filter_duration_6" name="filter[duration]" value="3600">
                                <label class="menu-item" for="filter_duration_6">60+ minutes</label>
                            </div>
                            <hr class="divider-horizontal">
                            <div class="radio filter_duration_setting filter-setting">
                                <input type="radio" id="filter_duration_8" name="filter[duration]" value="0-600">
                                <label class="menu-item" for="filter_duration_8">0-10 minutes</label>
                            </div>
                            <div class="radio filter_duration_setting filter-setting">
                                <input type="radio" id="filter_duration_9" name="filter[duration]" value="0-1200">
                                <label class="menu-item" for="filter_duration_9">0-20 minutes</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 视频时长 end -->

                <div class="filter-dropdown content-filter-container whitespace-nowrap">
                    <div class="filter-title-container flex justify-between px-3 desktop:hidden">
                        <div class="filter-header-title m-0 font-medium mb-1 text-base">
                            Source
                        </div>
                        <span class="filter-reset-advertiser_site content-filter-reset-button mobile:text-[var(--primary-active-text)]">
                            <i class="far fa-times mobile:hidden"></i>
                            <span class="desktop:hidden">reset</span>
                        </span>
                    </div>

                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" data-dropdown-placement="bottom-end" class="chip dropdown-toggle mobile:hidden">
                        <span class="label">Source</span>
                        <span class="sub-label hidden filter_advertiser_site_header content-filter-header menu-button" data-menu="filter_advertiser_site">
                            Source
                        </span>
                        <i class="far icon-end fa-chevron-down"></i>
                    </button>

                    <div class="dropdown-menu mobile-filter-dropdown-menu filter_advertiser_site_widget content-filter-widget desktop:scrollable-menu filter-options-partial"
                        aria-labelledby="dropdown-filter_advertiser_site" data-menu="filter_advertiser_site"
                        data-selected=""
                        data-options="{&quot;&quot;:&quot;All&quot;,&quot;40something&quot;:&quot;40Something&quot;,&quot;adultprime&quot;:&quot;AdultPrime&quot;,&quot;aebn&quot;:&quot;AEBN&quot;,&quot;amateureuro&quot;:&quot;AmateurEuro&quot;,&quot;analvids&quot;:&quot;AnalVids&quot;,&quot;av-jiali&quot;:&quot;AV Jiali&quot;,&quot;baberotica&quot;:&quot;Baberotica&quot;,&quot;bangbros&quot;:&quot;BangBros&quot;,&quot;brazzers&quot;:&quot;Brazzers&quot;,&quot;c4s&quot;:&quot;C4S&quot;,&quot;chickpass&quot;:&quot;ChickPass&quot;,&quot;clips4sale&quot;:&quot;Clips4sale&quot;,&quot;dorcelclub&quot;:&quot;DorcelClub&quot;,&quot;fancentro&quot;:&quot;FanCentro&quot;,&quot;faphouse&quot;:&quot;FapHouse&quot;,&quot;filthflix&quot;:&quot;FilthFlix&quot;,&quot;flirt4free&quot;:&quot;Flirt4Free&quot;,&quot;hentaied&quot;:&quot;Hentaied&quot;,&quot;industryinvaders&quot;:&quot;IndustryInvaders&quot;,&quot;it-s-pov&quot;:&quot;It's POV&quot;,&quot;japanhdv&quot;:&quot;JapanHDV&quot;,&quot;javhd&quot;:&quot;JavHD&quot;,&quot;kink&quot;:&quot;Kink&quot;,&quot;letsdoeit&quot;:&quot;Letsdoeit&quot;,&quot;loyalfans&quot;:&quot;LoyalFans&quot;,&quot;milfbundle&quot;:&quot;MilfBundle&quot;,&quot;modelcentro&quot;:&quot;ModelCentro&quot;,&quot;mr-skin&quot;:&quot;Mr. Skin&quot;,&quot;mylf&quot;:&quot;MYLF&quot;,&quot;mylfdom&quot;:&quot;MylfDom&quot;,&quot;naughtyamerica&quot;:&quot;NaughtyAmerica&quot;,&quot;naughtymag&quot;:&quot;NaughtyMag&quot;,&quot;parasited&quot;:&quot;Parasited&quot;,&quot;penthouse-gold&quot;:&quot;Penthouse Gold&quot;,&quot;pornbox&quot;:&quot;PornBox&quot;,&quot;pornworld&quot;:&quot;PornWorld&quot;,&quot;pvids&quot;:&quot;PVids&quot;,&quot;rfmovies&quot;:&quot;RFmovies&quot;,&quot;scoreland&quot;:&quot;Scoreland&quot;,&quot;sheer&quot;:&quot;Sheer&quot;,&quot;sinparty&quot;:&quot;SinParty&quot;,&quot;skyprivate&quot;:&quot;Skyprivate&quot;,&quot;teamskeet&quot;:&quot;TeamSkeet&quot;,&quot;tenshigao&quot;:&quot;Tenshigao&quot;,&quot;virtualrealpassion&quot;:&quot;VirtualRealPassion&quot;,&quot;virtualrealporn&quot;:&quot;VirtualRealPorn&quot;,&quot;xnxxgold&quot;:&quot;xnxxGold&quot;,&quot;xvideosred&quot;:&quot;XVideosRed&quot;}">
                        <div class="flex py-1 px-3">
                            <div class="input-container filter-input-container">
                                <input class="input" type="search" placeholder="Filter by source" id="filterInput" aria-label="Filter by source" autocomplete="off" maxlength="200">
                                <i class="icon-start far fa-bars-filter"></i>
                                <button class="clear-search-icon" aria-label="Clear search field" type="button">
                                    <i class="far fa-circle-xmark"></i>
                                </button>
                            </div>
                        </div>
                        <div class="filter-options-partial-options filter-wrap">
                            <div class="radio filter_advertiser_site_setting filter-setting" data-value="All">
                                <input type="radio" id="filter_advertiser_site_0" name="filter[advertiser_site]" value="all">
                                <label class="menu-item" for="filter_advertiser_site_0">All</label>
                            </div>
                            {foreach name="__SOURCES__" item="e" key="i" }
                                <div class="radio filter_advertiser_site_setting filter-setting"  data-value="40Something">
                                    <input type="radio" id="filter_advertiser_site_1" name="filter[advertiser_site]" value="{$e.title_en}">
                                    <label class="menu-item" for="filter_advertiser_site_1">{$e.title_en}</label>
                                </div>
                            {/foreach}
                        </div>
                        <div class="flex py-1 px-3 desktop:hidden">
                            <button type="button" id="getmore" class="button button-secondary w-full filter-options-partial-more">
                                显示更多
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <button id="submit-btn" class="button button-primary submit-button-form">确认筛选</button>
        </div>
        <!-- 过滤 end -->

    </form>

</div>