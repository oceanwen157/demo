<?php

namespace app\controller;

use app\BaseController;
use think\facade\Cache;

class Test extends BaseController
{
    public function index()
    {
        echo 'hello';
        Cache::store('redis')->set('name', 'value', 3600);
        $res = Cache::store('redis')->get("name");
        var_dump($res);
        return;
    }
}