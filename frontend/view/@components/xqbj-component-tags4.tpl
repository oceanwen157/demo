<div class="category-group-container grid grid-cols-[2rem_auto] gap-x-2 gap-y-8">
    {foreach name="__LISTS__" item="e" key="i" }
        <h3 class="category-sidebar-header m-0">
            <a href="/home/明星#{$e.tag3}" id="{$e.tag3}">{$e.tag3}</a>
        </h3>
        <div class="category-group" data-anchor="a">
            <ul class="w-full">
                {foreach name="e.sublist" item="o" key="i" }
                    <li class="category" data-title="{$e.username}">
                        <a class="anchor-link" href="/">
                            <span class="category-title">{$i + 1}{$o.username}</span>
                            <span class="badge badge-xsm">18+</span>
                            <span class="badge badge-text badge-xsm">{$e.view}</span>
                        </a>
                    </li>
                {/foreach}
            </ul>
        </div>
    {/foreach}
</div>