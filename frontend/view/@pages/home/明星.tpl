<!-- 模板引用 start -->
{layout name="@layout/screen" /}
<!-- 模板引用 end -->

<div id="content" class="flex flex-col container gap-3 pt-4 pb-6 px-3 mobile:px-2">
    <h1 class="content-header-title">
        {$navTitle}
    </h1>

    <!-- 索引 start -->
    <div id="mobile-anchor-top" class="flex gap-2 flex-wrap py-4">
        <a href="/a-z" class="button button-text">
            分类
        </a>
        {foreach name="$keys" item="e" key="i" }
            <a href="/pornstar/{$e|lower}" class="button button-text hide">
                {$e}
            </a>
        {/foreach}
    </div>
    <!-- 索引 end -->

    <!-- 列表 start -->
    {include file="@components/xqbj-component-tags4" /}
    <!-- 列表 end -->

    <!--  -->
    <div class="desktop:hidden all-categories-button-container flex gap-2 justify-center">
        <a href="/a-z" class="button button-secondary">
            {$Think.lang.categories}
        </a>
        <a href="/pornstar" class="button button-secondary">
            {$Think.lang.pornstars}
        </a>
    </div>
    <!--  -->

</div>