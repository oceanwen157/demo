<?php
namespace app\controller;

use app\BaseController;
use app\Services\DataService;
use think\facade\View;
use think\facade\App;
use think\facade\Env;
use think\facade\Request;

class Home extends BaseController
{
    public function 首页()
    {
        // $uri = Request::url();
        // if (strpos($uri, 'out/?l=') !== false) {
        //     $url = DataService::getRedirectUrl($uri);
        //     if ($url) {
        //         return redirect($url);
        //     }
        // }

        $recommend = DataService::getHomeVideos();

        View::assign('total', 0);
        View::assign('__RECOMMENDVIDEO__', $recommend['video']);
        View::assign('__OTHERCATEGORIES__', DataService::getOtherCategories());
        View::assign('__POPULARCATEGORIES__', DataService::getPopularCategories());
        View::assign('__POPULARSTARS__', DataService::getPopularPstars());
        
        
        return View::fetch('@pages/home/首页');
    }

    public function category($category)
    {
        $video = DataService::getCategoryVideoPaginate($category);

        View::assign('__RECOMMENDCATES__', DataService::getOtherCategories());
        View::assign('pagination', $video['paginate']);
        View::assign('navTitle', $category);
        View::assign('total', $video['total']);

        return View::fetch('@pages/home/主题');
    }

    public function search($keyword = '')
    {
        $searchVideo = DataService::searchVideos($keyword);

        View::assign('__RECOMMENDCATES__', DataService::getOtherCategories());
        View::assign('pagination', $searchVideo['paginate']);
        View::assign('navTitle', $keyword);
        View::assign('total', $searchVideo['total']);

        return View::fetch('@pages/home/主题');
    }

    public function popular()
    {
        $navTitle = 'Popular videos';
        $popurVideo = DataService::getPopularVideos();

        View::assign('__RECOMMENDCATES__', DataService::getOtherCategories());
        View::assign('pagination', $popurVideo['paginate']);

        View::assign('navTitle', $navTitle);
        View::assign('total', $popurVideo['total']);

        return View::fetch('@pages/home/主题');
    }

    public function new()
    {
        $navTitle = 'New videos';
        $newVideo = DataService::getNewVideos();

        View::assign('__RECOMMENDCATES__', DataService::getOtherCategories());
        View::assign('pagination', $newVideo['paginate']);

        View::assign('navTitle', $navTitle);
        View::assign('total', $newVideo['total']);

        return View::fetch('@pages/home/主题');
    }

    public function rating()
    {
        $navTitle = 'Top rated videos';
        $topRate = DataService::getTopRatedVideos(20);

        $recommend = DataService::getHomeVideos();
        View::assign('__RECOMMENDCATES__', $recommend['category']);
        View::assign('pagination', $topRate['paginate']);

        View::assign('navTitle', $navTitle);
        View::assign('total', $topRate['total']);
        
        
        return View::fetch('@pages/home/主题');
    }

    public function 主题()
    {

        return View::fetch('@pages/home/主题');
    }

    public function pornstar($pornstar)
    {
        if ($pornstar) {
            $video = DataService::getPstarVideoPaginate($pornstar);
            $recommend = DataService::getHomeVideos();
    
            View::assign('__RECOMMENDCATES__', $recommend['category']);
            View::assign('pagination', $video['paginate']);
            View::assign('navTitle', $pornstar);
            View::assign('total', $video['total']);

            return View::fetch('@pages/home/主题');
        }else{
            $res = DataService::getAllPstars();

            View::assign('navTitle', 'Pornstars');
            View::assign('__ALLSTARS__', $res);
            View::assign('keys', array_keys($res));
            return View::fetch('@pages/home/明星');
        }
    }

    public function pornstarCates()
    {
        $res = DataService::getAllPstars();

        View::assign('navTitle', 'Pornstars');
        View::assign('__ALLSTARS__', $res);
        View::assign('keys', array_keys($res));
        return View::fetch('@pages/home/明星');
    }

    public function az()
    {
        $res = DataService::getAllCategories();

        View::assign('navTitle', 'Categories');
        View::assign('__ALLSTARS__', $res);
        View::assign('keys', array_keys($res));
        return View::fetch('@pages/home/明星');
    }

    public function listdata()
    {
        $data = $this->listdata;
        return json($data);
    }
}
