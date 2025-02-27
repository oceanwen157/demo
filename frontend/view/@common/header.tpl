<!-- 公共部分/页面头部 -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover" />
    <meta name="referrer" content="same-origin">
    <title>{:strtolower(request()->action())} - {:strtolower(request()->controller())}</title>

    <!-- 引入样式文件 start -->
    <link rel="stylesheet" href="__ROOT_PATH__/__base/css/index.css" />
    <link rel="stylesheet" href="__ROOT_PATH__/@css/{:strtolower(request()->controller())}/{:strtolower(request()->action())}.css" />
    <!-- 引入样式文件 end -->
</head>