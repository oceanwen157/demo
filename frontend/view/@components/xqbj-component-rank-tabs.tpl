<!-- 通用组件/排行榜 -->
<div id="xqbj-rank-tabs">
    <div class="rank-title">
     <div class="xqbj-icon-hot"></div>
        <span>热榜</span>
    </div>

    <div class="rank-content">
        <div class="van-tabs van-tabs--card">
            <div class="van-tabs__wrap">
                <div class="van-tabs__nav van-tabs__nav--card" aria-orientation="horizontal">
                    <div class="van-tab van-tab--card van-tab--active" data-index="0">
                        <span class="van-tab__text van-tab__text--ellipsis">UP主</span>
                    </div>
                    <div class="van-tab van-tab--card" data-index="1">
                        <span class="van-tab__text van-tab__text--ellipsis">贴文</span>
                    </div>
                </div>
            </div>
            <div class="van-tabs__content">
                <div class="van-tab__panel">
                    <div v-for="(item, index) in rankList" :key="index" v-if="rankList?.length">
                        <a href="/ta/个人中心" class="rank-card">
                            <div class="rank-card-icon">
                                <img v-if="index == 0" src="__ROOT_PATH__/__base/images/rank1@3x.png">
                                <img v-else-if="index == 1" src="__ROOT_PATH__/__base/images/rank2@3x.png">
                                <img v-else-if="index == 2" src="__ROOT_PATH__/__base/images/rank3@3x.png">
                                <span v-else>{{ index+1 }}</span>
                            </div>
                            <div class="rank-card-content">
                                <div class="rank-card-content-avatar">
                                    <img :z-image-loader-url="item.imageUrl" />
                                </div>
                                <div class="rank-card-content-content">
                                    <div class="rank-card-content-content-name text-line-ellipsis-1">{{item.username}}</div>
                                    <div class="rank-card-content-content-fans text-line-ellipsis-1">粉丝数：{{item.view}}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <a href="/home/热榜" class="viewMore" id="rank_up_viewMore">查看更多 ></a>
                </div>
                <div class="van-tab__panel hidden">
                    {foreach name="__LISTS__" item="e" key="i" }
                        <a href="/welfare/福利详情" class="rank-card rank-card-two">
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
                           <div class="rank-card-content">
                                <div class="rank-card-content-content">
                                    <div class="rank-card-content-content-name text-line-ellipsis-1">{$e.subtitle}</div>
                                </div>
                            </div>
                        </a>
                    {/foreach}
                    <a href="/home/往期" class="viewMore" id="rank_up_viewMore">查看更多 ></a>
                </div>
            </div>
        </div>
    </div>
</div>