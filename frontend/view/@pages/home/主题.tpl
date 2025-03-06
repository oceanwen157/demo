<!-- 模板引用 start -->
{layout name="@layout/screen" /}
<!-- 模板引用 end -->

<div id="content" class="flex flex-col container gap-3 pt-4 pb-6 px-3 mobile:px-2">
    <h1 class="content-header-title capitalize flex items-center gap-1" dir="auto">
        {$navTitle}<span class="font-normal text-dimmed text-md">({$total})</span>
    </h1>

    <div class="content-grid">
        <!-- 过滤 start -->
        {include file="@components/xqbj-component-filter" /}
        <!-- 过滤 end -->

        <!-- 列表 start -->
        <div class="content-block">
            {include file="@components/xqbj-component-list-101" /}
        </div>
        <!-- 列表 end -->

        <!-- 分页 start -->
        {include file="@components/xqbj-component-pagination" /}
        <!-- 分页 end -->
    </div>

    <!-- 推荐 start -->
    {include file="@components/xqbj-component-tags3" /}
    <!-- 推荐 end -->

    <!--  -->
    <div class="all-categories-button-container flex gap-2 justify-center">
        <a href="/a-z" class="button button-secondary">{$Think.lang.categories}</a>
        <a href="/pornstar" class="button button-secondary">{$Think.lang.pornstars}</a>
    </div>
    <!--  -->
</div>
