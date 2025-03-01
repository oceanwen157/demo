<!-- 通用组件/tag -->
<div class="tag-block">
    <div class="pill-group-container">
        <h2 class="flex justify-between text-base">
            相关推荐
        </h2>
        <div class="pill-group">
            <div class="pill-container">
                {foreach name="__RECOMMENDCATES__" item="e" key="i" }
                    <a href="/category/{$e->title_en}" class="pill">
                        <span class="pill-text">{$e->title_en}</span>
                        <span class="badge badge-xsm">{if $e->age_limit}{$e->age_limit}+{/if}</span>
                    </a>
                {/foreach}
            </div>
        </div>
    </div>
</div>