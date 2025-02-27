<!-- 通用组件/tag -->
<div class="tag-block">
    <div class="pill-group-container">
        <h2 class="flex justify-between text-base">
            相关推荐
        </h2>
        <div class="pill-group">
            <div class="pill-container">
                {foreach name="__LISTS__" item="e" key="i" }
                    <a href="/home/主题" class="pill">
                        <span class="pill-text">{$e.username}</span>
                        <span class="badge badge-xsm">18+</span>
                    </a>
                {/foreach}
            </div>
        </div>
    </div>
</div>