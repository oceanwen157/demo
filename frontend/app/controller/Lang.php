<?php

namespace app\controller;


use app\BaseController;
use app\Services\DataService;
use think\facade\Cache;
use think\Request;

class Lang extends BaseController
{

    const AllowLangs = [
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
    ];


    /**
     * 切换语言
     * @param Request $request
     * @return \think\response\Redirect
     */
    public function switch(Request $request)
    {
        $lang = strtolower(trim($request->get('lang')));
        if (in_array($lang, self::AllowLangs)) {
            cookie('think_lang', $lang);

            $lastUrl = trim($_SERVER['HTTP_REFERER'] ?? '');
            if (!empty($lastUrl)) {
                return redirect($lastUrl);
            }
        }

        return redirect('/');
    }

}