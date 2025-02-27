<div class="grid grid-cols-[repeat(auto-fill,minmax(180px,1fr))] gap-4 relative">
    {foreach name="__LISTS__" item="e" key="i" }
    <div class="network-card">
        <a class="logo-container network-grid-logo" href="/cooperate/合作详情" title="{$e.text}">
            <div class="logo-default">
                <img class="" z-image-loader-url="{$e.imageUrl}" loading="eager" alt="{$e.text}"/>
            </div>
            <h3 class="block w-full text-center m-0 text-md px-3 py-2 filter network-button-container rounded-b">{$e.username}</h3>
        </a>
    </div>
    {/foreach}
</div>