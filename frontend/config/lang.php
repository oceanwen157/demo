<?php
// +----------------------------------------------------------------------
// | 多语言设置
// +----------------------------------------------------------------------

return [
    // 默认语言
    'default_lang' => env('lang.default_lang', 'en'),
    // 允许的语言列表
    'allow_lang_list' => [
        'en',
        'cn',
        'tw',
        'ja',
        'ko',
        'ms',
        'th',
        'de',
        'vi',
        'id',
        'pt',
        'tlph',
    ],
    // 多语言自动侦测变量名
    'detect_var' => 'lang',
    // 是否使用Cookie记录
    'use_cookie' => true,
    // 多语言cookie变量
    'cookie_var' => 'think_lang',
    // 多语言header变量
    'header_var' => 'think-lang',
    // 扩展语言包
    'extend_list' => [],
    // Accept-Language转义为对应语言包名称
    'accept_language' => [
//        'zh-hans-cn' => 'cn',
//        'zh-cn' => 'cn',
//        'zh-tw' => 'tw',
//        'zh-hk' => 'tw',
//        'en-us' => 'en',
//        'ja' => 'ja',
//        'ko' => 'ko',
//        'ms' => 'ms',
//        'thai' => 'th',
//        'de' => 'de',
//        'vi' => 'vi',
//        'id' => 'id',
//        'pt' => 'pt',
//        'tl-ph' => 'tlph',
    ],
    // 是否支持语言分组
    'allow_group' => false,
];
