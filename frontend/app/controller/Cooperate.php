<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;
use think\facade\App;
use think\facade\Env;
use think\facade\Request;

class Cooperate extends BaseController
{
    public function 合作列表()
    {
        return View::fetch('@pages/cooperate/合作列表');
    }

    public function 合作详情()
    {
        return View::fetch('@pages/cooperate/合作详情');
    }
}
