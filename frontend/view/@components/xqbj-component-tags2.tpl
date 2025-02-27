<!-- 通用组件/tag -->
<div class="popular-list">
    <h3 class="mb-0">
        热门分类 A-Z
    </h3>
    <ul class="category-group pt-4">
        {foreach name="__LISTS__" item="e" key="i" }
            <li class="flex gap-2 pb-8">
                <h3>
                    <a class="flex align-items-start w-6" href="/a-z/%23">
                        {$e.tag3}
                    </a>
                </h3>
                <div>
                    {foreach name="$e.sublist" item="o" key="j" }
                        <a class="flex items-center gap-1" href="/home/主题" title="{$o.text}" target="_self">
                            <span class="category-text">{$o.text}</span>
                            <span class="badge badge-text badge-xsm">{$o.view}K</span>
                        </a>
                    {/foreach}
                </div>
            </li>
        {/foreach}
    </ul>
    <div class="mt-4 text-center">
        <a href="/home/明星" class="button button-secondary">Categories</a>
    </div>
</div>