<!-- 搜索组件 start -->

<div class="search-container">

    <div class="search-title">
        <span>历史记录</span>
        <div class="r-text emptyRecord">
            <div class="xqbj-icon-delete icon"></div> 清空记录
        </div>
    </div>

    <div class="container-search-tags">
        <div class="list history-record">
            
         </div>
    </div>

    <div class="search-title search-border">
        <span>热门搜索</span>
    </div>

  <div class="container-search-hots">
        <div class="rank-list">
            {foreach name="__LISTS__" item="e" key="i" }
                <a href="/welfare/福利详情" class="rank-card">
                    <div class="rank-card-icon">
                        {if $i === 0}
                            <img src="__ROOT_PATH__/__base/images/rank1@3x.png">
                        {elseif $i === 1}
                            <img src="__ROOT_PATH__/__base/images/rank2@3x.png">
                        {elseif $i === 2}
                            <img src="__ROOT_PATH__/__base/images/rank3@3x.png">
                        {else}
                            {$i + 1}
                        {/if}
                    </div>
                    <div class="rank-card-title text-line-ellipsis-1">{$e.subtitle}</div>
                    <div class="flex">
                       <div class="xqbj-icon-fire rank-card-icon"></div>
                       <span>{$e.view}</span>
                    </div>
                </a>
            {/foreach}
        </div>
    </div>

    <!-- 
    <div class="container-search-tags hot-tags">
        <div class="list">
            {foreach name="__LISTS__" item="e" key="i" }
                 <a href="###">{$e.tag2}</a>
            {/foreach}
        </div>
    </div>
    -->

</div>
<!-- 搜索组件 end -->