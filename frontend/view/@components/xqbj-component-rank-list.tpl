<!-- 通用组件/排行榜 -->
<div id="xqbj-rank-list">
    <div class="content">
        {foreach name="__LISTS__" item="e" key="i" }
            <a href="#{$i}" class="rank-card">
                <div class="top">
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
                        <div class="rank-card-content-avatar">
                            <img z-image-loader-url="`{$e.imageUrl}`" />
                        </div>
                        <div class="rank-card-content-content">
                            <div class="rank-card-content-content-name text-line-ellipsis-1">{$e.username}</div>
                            <div class="rank-card-content-content-fans">
                                <div class="item"><span>{$e.view}</span>粉丝</div>
                                <div class="item"><span>{$e.view}</span>订阅</div>
                                <div class="item"><span>{$e.view}</span>获赞</div>
                            </div>
                        </div>
                        <div class="rank-card-content-follow">
                            {if $e.active}
                                <div class="button follow-btn active" data-id="{$i}">
                                    已订阅<div class="xqbj-icon-subscription"></div>
                                </div>
                            {else}
                                <div class="button follow-btn" data-id="{$i}">
                                    订阅<div class="xqbj-icon-unsubscription"></div>
                                </div>
                            {/if}
                        </div>
                    </div>
                </div>
                <div class="bottom ">
                    <div class="describe">
                        <span>签名：</span>{$e.subtitle}
                    </div>
                </div>
            </a>
        {/foreach}
    </div>
</div>