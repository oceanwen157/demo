<div class="grid grid-cols-[repeat(auto-fill,minmax(180px,1fr))] gap-4 relative">
    {foreach name="__NETWORKS__" item="e" key="i" }
    <div class="network-card">
        <a class="logo-container network-grid-logo" href="{$e.route_path}" title="{$e.title_en}">
            <div class="logo-default">
                <img class="" z-image-loader-url="{$e.logo}" loading="eager" alt="{$e.name}"/>
            </div>
            <h3 class="block w-full text-center m-0 text-md px-3 py-2 filter network-button-container rounded-b">{$e.title_en}</h3>
        </a>
    </div>
    {/foreach}
</div>