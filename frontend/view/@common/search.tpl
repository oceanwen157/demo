<!-- 公共部分/头部导航 -->
       
<!-- 搜索导航(桌面端) start -->
<div class="mobile:hidden flex gap-2 mobile:basis-[100%] mobile:order-3 mobile:min-w-full grow mobile:px-0">
    <div class="form search grow flex">
        <form name="search_query" method="post" target="_self" class="relative grow">
            <div id="search_query" class="flex justify-center">
                <div class="input-container">
                    <input type="search" name="search_query[query]" id="search_query_query" class="input search_query" placeholder="Search 45,673,628 videos ..." aria-label="Search 45,673,628 videos ..." autocomplete="off" maxlength="200" value="" required="">
                    <button class="clear-search-icon" aria-label="Clear search field" type="button">
                        <i class="far fa-circle-xmark"></i>
                    </button>
                    <button aria-label="Search button" class="icon-end search-btn">
                        <i class="far fa-fw fa-search"></i>
                    </button>
                </div>
                <div class="autocomplete">
                    <!-- 搜索词条 start -->
                    <div class="no-results show search-btn">
                        <i class="no-results-icon far fa-arrow-turn-down-right"></i>
                        <span>搜索 <strong><a href="/ssssss" class="search-key"></a></strong></span>
                    </div>
                    <!-- 搜索词条 end -->

                    <!-- 推荐列表 start -->
                    <ul class="autocomplete-list">
                        <!-- 热门搜索 start -->
                        <div class="autocomplete-group-container hidden hot-search-ul-list">
                            <div class="group-header">
                                <span class="title"><div style="vertical-align: inherit;">热门搜索</div></span>
                                <div class="divider"></div>
                            </div>
                        </div>
                        <!-- 热门搜索 end -->
                    
                        <!-- 热门类别 start -->
                        <div class="autocomplete-group-container hidden type-search-ul-list">
                            <div class="group-header">
                                <span class="title"><div style="vertical-align: inherit;">热门类别</div></span>
                                <div class="divider"></div>
                            </div>
                        </div>
                        <!-- 热门类别 end -->

                        <!-- 热门明星 start -->
                        <div class="autocomplete-group-container hidden star-search-ul-list">
                            <div class="group-header">
                                <span class="title"><div style="vertical-align: inherit;">热门明星</div></span>
                                <div class="divider"></div>
                            </div>
                        </div>
                        <!-- 热门明星 end -->
                    </ul>
                    <!-- 推荐列表 end -->

                    <!-- 操作按钮 start -->
                    <div class="flex justify-center p-4 w-full gap-2">
                        <a class="button button-secondary px-4 search-btn">搜索</a>
                        <a href="/#随机视频" class="button button-secondary px-4">随机</a>
                    </div>
                    <!-- 操作按钮 end -->
                </div>
            </div>
        </form>
    </div>
</div>
<!-- 搜索导航(桌面端) end -->

<!-- 搜索导航(移动端) start -->
<div class="desktop:hidden flex gap-2 mobile:basis-[100%] mobile:order-3 mobile:min-w-full grow mobile:px-0  search_query_mobile_container">
    <div class="flex form search grow">
        <form name="search_query_mobile_trigger" method="post" class="w-full search_form relative grow" target="_self" data-url="/search-term/suggest-grouped/__queryString__">
            <div id="search_query_mobile" class="">
                <div class="input-container">
                    <input type="search" id="search_query_mobile_trigger_query" name="search_query_mobile" class="input search_query" placeholder="Search 45,673,628 videos ..." aria-label="Search 45,673,628 videos ..." autocomplete="off" maxlength="200" value="" required="">
                    <button type="submit" aria-label="Search button" class="icon-end">
                        <i class="far fa-fw fa-search"></i>
                    </button>
                    <button type="button" class="button button-text close-autocomplete">Close</button>
                </div>
                <div class="autocomplete">
                    <!-- 搜索词条 start -->
                    <div class="no-results show">
                        <i class="no-results-icon far fa-arrow-turn-down-right"></i>
                        <span>搜索 <strong><a href="/" class="search-key"></a></strong></span>
                    </div>
                    <!-- 搜索词条 end -->

                    <!-- 推荐列表 start -->
                    <ul class="autocomplete-list">
                        <!-- 热门搜索 start -->
                        <div class="autocomplete-group-container hidden hot-search-ul-list">
                            <div class="group-header">
                                <span class="title"><div style="vertical-align: inherit;">热门搜索</div></span>
                                <div class="divider"></div>
                            </div>
                        </div>
                        <!-- 热门搜索 end -->
                    
                        <!-- 热门类别 start -->
                        <div class="autocomplete-group-container hidden type-search-ul-list">
                            <div class="group-header">
                                <span class="title"><div style="vertical-align: inherit;">热门类别</div></span>
                                <div class="divider"></div>
                            </div>
                        </div>
                        <!-- 热门类别 end -->

                        <!-- 热门明星 start -->
                        <div class="autocomplete-group-container hidden star-search-ul-list">
                            <div class="group-header">
                                <span class="title"><div style="vertical-align: inherit;">热门明星</div></span>
                                <div class="divider"></div>
                            </div>
                        </div>
                        <!-- 热门明星 end -->
                    </ul>
                    <!-- 推荐列表 end -->

                    <!-- 操作按钮 start -->
                    <div class="flex justify-center p-4 w-full gap-2">
                        <a type="submit" class="button button-secondary px-4">搜索</a>
                        <a href="/#随机视频" class="button button-secondary px-4">随机</a>
                    </div>
                    <!-- 操作按钮 end -->
                </div>
            </div>
        </form>
    </div>
</div>
<!-- 搜索导航(移动端) end -->