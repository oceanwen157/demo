<!-- 模板引用 start -->
{layout name="@layout/screen" /}
<!-- 模板引用 end -->
<div id="content" class="flex flex-col container gap-3 pt-4 pb-6 px-3 mobile:px-2">
    <div class="flex flex-col gap-4" dir="ltr">
        <h1 class="content-header-title">{$info.name}</h1>
        <div class="grid desktop:grid-cols-[350px_1fr] gap-8">
            <div class="flex flex-col rounded">
                <a class="logo-container network-logo" href="/network/{$info.route_path}" title="{$info.name}" target="_blank">
                    <div class="logo-default">
                        <img class="" z-image-loader-url="{$info.logo}" loading="eager" alt="{$info.title_en}"/>
                    </div>
                </a>
                <div class="block w-full text-center m-0 text-md filter rounded-b p-2 network-button-container">
                    <a href="/network/{$info.route_path}" class="button button-secondary w-full h-full" target="_blank">
                        {$info.hint_en }
                    </a>
                </div>
            </div>
            <div class="flex flex-col gap-4">
                <h3 class="m-0 p-0">{$info.title_en}</h3>
                <ul class="list-none p-0 m-0 flex flex-col gap-2">
<!--
                    <li class="flex gap-4 items-center"><i class="far fa-check"></i><span>最大的色情视频集合！4000 多万个视频！</span></li>
                    <li class="flex gap-4 items-center"><i class="far fa-check"></i><span>每日更新</span></li>
                    <li class="flex gap-4 items-center"><i class="far fa-check"></i><span>最佳内容推荐算法</span></li>
                    <li class="flex gap-4 items-center"><i class="far fa-check"></i><span>令人难以置信的过滤器</span></li>
                    <li class="flex gap-4 items-center"><i class="far fa-check"></i><span>出色的高级搜索</span></li>
                    {foreach name="__LISTS__" item="e" key="i" }
                        <li class="flex gap-4 items-center">
                            <i class="far fa-check"></i><span class="hides"> {$e.username}</span>
                        </li>
                    {/foreach}
-->
                    {$info.description_en}
                </ul>
            </div>
        </div>
    </div>

</div>

