<!-- 通用组件/列表 -->

<div class="cards-container">
    {foreach name="__RECOMMENDVIDEO__" item="e" key="i" }
        <div class="card group">
            <a width="360" height="200" aria-hidden="true" tabindex="-1" class="relative block item-link" href="/category/{$e.category.route_path}" title="{$e.video.title_en} ">
                <img class="item-image" z-image-loader-url="{$imgSite}{$e.video.cover_new}" loading="eager"  alt="{$e.video.title_en}"/>
                <span class="hidden no-image">No video available</span>
                <span class="badge absolute left-1 bottom-1">{$e.video.duration_num}K</span>
            </a>
            <a class="pl-1 collection-title" href="/category/{$e.category.route_path}" title="{$e.category.title_en}">
                <h3 class="m-0 w-full overflow-hidden truncate text-ellipsis text-md flex items-center gap-1">
                    {$e.category.title_en}
                </h3>
            </a>
        </div>
    {/foreach}
</div>

<!-- 分页 start -->
{include file="@components/xqbj-component-pagination" /}
<!-- 分页 end -->
