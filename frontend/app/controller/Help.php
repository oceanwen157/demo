<?php

namespace app\controller;

use app\BaseController;
use app\model\Helps;
use think\exception\HttpException;
use think\facade\View;
use think\facade\App;
use think\facade\Env;
use think\facade\Request;
use voku\helper\UTF8;

class Help extends BaseController
{
    public function 常见问题()
    {
        return View::fetch('@pages/help/常见问题');
    }

    public function 联系我们()
    {
        return View::fetch('@pages/help/联系我们');
    }

    public function 帮助改进()
    {
        return View::fetch('@pages/help/帮助改进');
    }

    public function 服务条款()
    {
        return View::fetch('@pages/help/服务条款');
    }

    public function 隐私声明()
    {
        return View::fetch('@pages/help/隐私声明');
    }

    public function 删除声明()
    {
        return View::fetch('@pages/help/删除声明');
    }

    public function 版权声明()
    {
        return View::fetch('@pages/help/版权声明');
    }

    public function 数字服务()
    {
        return View::fetch('@pages/help/数字服务');
    }

    public function 豁免声明()
    {
        return View::fetch('@pages/help/豁免声明');
    }


    public function detail($route)
    {
        $route = trim($route);
        $row = Helps::where('route_path', $route)->find();
        if (!$row) {
            throw new HttpException(404, 'the page does not exist');
        }

        View::assign('row', $row);
        return View::fetch('@pages/help/detail');
    }


}
