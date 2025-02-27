<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;
use think\facade\App;
use think\facade\Env;
use think\facade\Request;

class Home extends BaseController
{
    public function 首页()
    {
        return View::fetch('@pages/home/首页');
    }

    public function 主题()
    {
        return View::fetch('@pages/home/主题');
    }

    public function 明星()
    {
        return View::fetch('@pages/home/明星');
    }

    public function listdata()
    {
        $data = $this->listdata;
        return json($data);
    }
}
