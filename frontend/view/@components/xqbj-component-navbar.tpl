<!-- 通用组件/navbar -->
{volist name="__NAVBARS__" id="e" key="i"}
    <div class="item {if condition='!empty($e.activa)'} activa {/if}">
        <div class="head" onclick="onMenuOpen(this)" direction="down" class="downbtn" data-bs-toggle="collapse" data-bs-target="#collapseTag{$i}1" aria-controls="collapseTag{$i}" 
        aria-expanded="{if condition='$i === 3'}true{else}false{/if}">
            <div class="left">
                <div class="xqbj-icon-nav-image icon-nav"></div>
                <div class="title"><a href="{$e.url}" class="text-line-ellipsis-1">{$e.title}</a></div>
                <div class="subtitle"></div>
            </div>
            <div class="right">
                <img class="icon-btn" src="__ROOT_PATH__/__base/images/icon-{if condition='$i === 3'}minus{else}plus{/if}.png">
            </div>
        </div>
        <div class="collapse content-collapse {if condition='$i === 3'}show{/if}" id="collapseTag{$i}">
            <div class="tags">
                {volist name="e.tags" id="o" key="j"}
                    <div class="tag-text text-line-ellipsis-1">
                        <a href="/#{$i}" class="{if condition='$j === 1 && $i === 1'}selected{/if}" onclick="onTagSelected(this, {$i}, {$j})">{$o.text}</a>
                    </div>
                {/volist}
            </div>
        </div>
    </div>
{/volist}