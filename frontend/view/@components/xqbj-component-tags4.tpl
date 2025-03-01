<div class="category-group-container grid grid-cols-[2rem_auto] gap-x-2 gap-y-8">
    {foreach name="__ALLSTARS__" item="e" key="i" }
        <h3 class="category-sidebar-header m-0">
            <a href="/pornstar/{$i}" id="{$i}">{$i}</a>
        </h3>
        <div class="category-group" data-anchor="a">
            <ul class="w-full">
                {foreach name="$e" item="o" key="i" }
                    <li class="category" data-title="{$o->title_en}">
                        <a class="anchor-link" href="/pornstar/{$o->title_en}">
                            <span class="category-title">{$o->title_en}</span>
                            <span class="badge badge-xsm">{if $o->age_limit}{$o->age_limit}+{/if}</span>
                            <span class="badge badge-text badge-xsm">{$e.quantity_desc}</span>
                        </a>
                    </li>
                {/foreach}
            </ul>
        </div>
    {/foreach}
</div>