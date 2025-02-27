<?php

namespace app\controller;

use app\BaseController;
use app\Services\DataService;
use think\facade\Cache;

class Test extends BaseController
{
    public function index()
    {
        echo 'hello';
        $res = DataService::getSources();
        $res2 = getTitleByLang($res[0]);
        var_dump($res, $res2);
        return;
    }
}