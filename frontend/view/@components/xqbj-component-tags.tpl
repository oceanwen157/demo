<!-- 通用组件/tag -->
<div class="pill-group-container">
    <div class="pill-group scrollable pb-6">
        <div class="pill-container">
            {foreach name="__OTHERCATEGORIES__" item="e" key="i" }
                <a href="/category/{$e->title_en}" class="pill">
                    {$e->title_en}
                </a>
            {/foreach}
            <a href="/a-z" class="pill show-more-searches-pill">
                <i class="icon-start far fa-list"></i>
                Show more
            </a>
        </div>
        <div class="pill-scroll-left hidden">
            <button type="button" class="button button-text rounded-full min-w-0 w-[34px] h-[34px]">
                <i class="icon-start far fa-chevron-left"></i>
            </button>
        </div>
        <div class="pill-scroll-right">
            <button type="button" class="button button-text rounded-full min-w-0 w-[34px] h-[34px]">
                <i class="icon-start far fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>