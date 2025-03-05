<!-- 模板引用 start -->
{layout name="@layout/screen" /}
<!-- 模板引用 end -->

<div id="content" class="flex flex-col container gap-3 pt-4 pb-6 px-3 mobile:px-2">
    <h2 class="content-header-title">
        {$Think.lang.homeHeaderTitle}
    </h2>
    
    <!-- 列表 start -->
    {include file="@components/xqbj-component-list-100" /}
    <!-- 列表 end -->

    <!-- 标签 start -->
    {include file="@components/xqbj-component-tags" /}
    <!-- 标签 end -->

    <div class="flex-grow-1 mobile:hidden flex flex-col gap-8">

        <!-- 标签2 start -->
        {include file="@components/xqbj-component-tags2" /}
        <!-- 标签2 end -->
    
        <!-- 标签2 start -->
        {include file="@components/xqbj-component-tags2" /}
        <!-- 标签2 end -->

    </div>
</div>
