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
        $res = DataService::getNewVideos(20);
        var_dump($res);
        return;
    }
}