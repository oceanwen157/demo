<!-- 通用组件/navbar -->
{volist name="__NAVBARS__" id="e" key="i"}
    <div class="item {if condition='!empty($e.activa)'} activa {/if}">
        <div class="head" direction="down" class="downbtn" data-bs-toggle="collapse" data-bs-target="#collapseTag{$i}" aria-controls="collapseTag{$i}" aria-expanded="true">
            <div class="left">
                <div class="xqbj-icon-nav-image icon-nav"></div>
                <div class="title"><a href="{$e.url}" class="text-line-ellipsis-1">{$e.title}</a></div>
                <div class="subtitle"></div>
            </div>
            <div class="right">
                
            </div>
        </div>
        <div class="collapse content-collapse show" id="collapseTag{$i}Stop">
            <div class="tags">
                {volist name="e.tags" id="o" key="j"}
                    <div class="tag-text text-line-ellipsis-1">
                        <a href="{$o.url}" class="{if condition='$j === 1 && $i === 1'}selected{/if}" onclick="onTagSelected(this, {$i}, {$j})">{$o.text}</a>
                    </div>
                {/volist}
            </div>
        </div>
    </div>
{/volist}

<!-- 往期历史 start -->
<div class="item">
    <div class="head">
        <div class="left">
            <div class="xqbj-icon-nav-image icon-nav"></div>
            <div class="title"><a href="#" class="text-line-ellipsis-1">往期历史</a></div>
            <div class="subtitle"></div>
        </div>
        <div class="right">
            
        </div>
    </div>
    <div class="collapse content-collapse show">
        <div class="tags">
            <div class="tag-text text-line-ellipsis-1">
                <a href="/home/标签">标签云</a>
            </div>
            <div class="tag-text text-line-ellipsis-1">
                <a href="/home/往期">往期贴文</a>
            </div>
            <div class="tag-text text-line-ellipsis-1">
                <a href="/home/热榜">热门榜单</a>
            </div>
        </div>
    </div>
</div>
<!-- 往期历史 end -->

<!-- 联系方式 start -->
<div class="item">
    <div class="head">
        <div class="left">
            <div class="xqbj-icon-nav-image icon-nav"></div>
            <div class="title"><a href="#" class="text-line-ellipsis-1">联系我们</a></div>
            <div class="subtitle"></div>
        </div>
        <div class="right">
            
        </div>
    </div>
    <div class="collapse content-collapse show">
        <div class="tags">
            <div class="tag-text text-line-ellipsis-1 rows">
                <div class="xqbj-icon-qq"></div>
                <a class="qq" href="/#官方QQ群">官方QQ群</a>
            </div>
            <div class="tag-text text-line-ellipsis-1 rows">
                <div class="xqbj-icon-sw"></div>
                <a href="/#商务合作">商务合作</a>
            </div>
            <div class="tag-text text-line-ellipsis-1 rows">
                <div class="xqbj-icon-tg"></div>
                <a href="/#官方TG群">官方TG群</a>
            </div>
            <div class="tag-text text-line-ellipsis-1 rows">
                <div class="xqbj-icon-wt"></div>
                <a href="/#官方推特">官方推特</a>
            </div>
        </div>
    </div>
</div>
<!-- 联系方式 end -->