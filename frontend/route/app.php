<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::group('', function() {
    Route::get('', 'home/首页');

    Route::get('category/:category', 'home/category')->pattern(['category' => '[\w\-]+']);

    Route::get('pornstar/:pornstar', 'home/pornstar')->pattern(['pornstar' => '[\w\-]+']);
    Route::get('pornstar', 'home/pornstarCates');
    Route::get('a-z', 'home/az');

    Route::get('popular', 'home/popular');
    Route::get('new', 'home/new');
    Route::get('rating', 'home/rating');
    
    Route::get('search/:keyword', 'home/search')->pattern(['keyword' => '[\w\-]+']);
    Route::get('search', 'home/search');

    Route::get('network/:keyword', 'home/network')->pattern(['keyword' => '[\w\-]+']);
    Route::get('network', 'home/network');

    Route::post('videorate', 'home/videorate');

    Route::get('help/:route', 'help/detail')->pattern(['route' => '[\w\-]+']);

    Route::get('登陆', 'popup/登陆');
    Route::get('注册', 'popup/注册');
    Route::get('找回', 'popup/找回');
    Route::get('公告', 'popup/公告');
    Route::get('通知', 'popup/通知');
    Route::get('十八', 'popup/十八');
    Route::get('精品', 'popup/精品');
    
});


