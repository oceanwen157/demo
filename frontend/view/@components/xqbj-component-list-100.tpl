<!-- 通用组件/列表 -->

<div class="cards-container">
    {foreach name="__LISTS__" item="e" key="i" }
        <div class="card group">
            <a width="360" height="200" aria-hidden="true" tabindex="-1" class="relative block item-link" href="/home/主题" title="{$e.username} ">
                <img class="item-image" z-image-loader-url="{$e.imageUrl}" loading="eager"  alt="{$e.username}"/>
                <span class="hidden no-image">No video available</span>
                <span class="badge absolute left-1 bottom-1">{$e.view}K</span>
            </a>
            <a class="pl-1 collection-title" href="/home/主题#{$e.text}" title="{$e.text} ">
                <h3 class="m-0 w-full overflow-hidden truncate text-ellipsis text-md flex items-center gap-1">
                    {$e.text}
                </h3>
            </a>
        </div>
    {/foreach}
</div>

<!-- 分页 start -->
{include file="@components/xqbj-component-pagination" /}
<!-- 分页 end -->