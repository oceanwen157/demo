<!-- 通用组件/tag -->
<div class="popular-list">
    <h3 class="mb-0">
        热门分类 A-Z
    </h3>
    <ul class="category-group pt-4">
        {foreach name="__POPULARCATEGORIES__" item="e" key="i" }
            <li class="flex gap-2 pb-8">
                <h3>
                    <a class="flex align-items-start w-6" href="/a-z">
                        {$i}
                    </a>
                </h3>
                <div>
                    {foreach name="$e" item="o" key="j" }
                        <a class="flex items-center gap-1" href="/category/{$o->title_en}" title="{$o->title_en}" target="_self">
                            <span class="category-text">{$o->title_en}</span>
                            <span class="badge badge-text badge-xsm">{$o->quantity_desc}</span>
                        </a>
                    {/foreach}
                </div>
            </li>
        {/foreach}
    </ul>
    <div class="mt-4 text-center">
        <a href="/a-z" class="button button-secondary">Categories</a>
    </div>
</div>

<!-- 通用组件/tag -->
<div class="popular-list">
    <h3 class="mb-0">
        流行明星 A-Z
    </h3>
    <ul class="category-group pt-4">
        {foreach name="__POPULARSTARS__" item="e" key="i" }
            <li class="flex gap-2 pb-8">
                <h3>
                    <a class="flex align-items-start w-6" href="/a-z">
                        {$i}
                    </a>
                </h3>
                <div>
                    {foreach name="$e" item="o" key="j" }
                        <a class="flex items-center gap-1" href="/category/{$o->title_en}" title="{$o->title_en}" target="_self">
                            <span class="category-text">{$o->title_en}</span>
                            <span class="badge badge-text badge-xsm">{$o->quantity_desc}</span>
                        </a>
                    {/foreach}
                </div>
            </li>
        {/foreach}
    </ul>
    <div class="mt-4 text-center">
        <a href="/pornstar" class="button button-secondary">Pornstars</a>
    </div>
</div>