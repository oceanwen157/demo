<!-- 模板引用 start -->
{layout name="@layout/screen" /}
<!-- 模板引用 end -->

<div id="content" class="flex flex-col container gap-3 pt-4 pb-6 px-3 mobile:px-2">
    <h1 class="content-header-title" dir="ltr">
        {$row|getLangValueByField}
    </h1>

    <div class="flex flex-col gap-6" dir="ltr">
        {$row|getLangValueByField=###,"content"|raw}
    </div>

</div>