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

        $recommend = DataService::getHomeVideos($this->lang);

        View::assign('total', 0);
        View::assign('__RECOMMENDVIDEO__', $recommend);
        View::assign('__OTHERCATEGORIES__', DataService::getOtherCategories($this->lang));
        View::assign('__POPULARCATEGORIES__', DataService::getPopularCategories($this->lang));
        View::assign('__POPULARSTARS__', DataService::getPopularPstars($this->lang));
        
        
        return View::fetch('@pages/home/首页');
    }

    public function category($category = '')
    {

        $filters = Request::param('filter');
        $orderBy = $filters['order_by'] ?? 'popular';

        $video = DataService::getCategoryVideoPaginate($this->lang, $filters, $category);

        View::assign('__RECOMMENDCATES__', DataService::getOtherCategories($this->lang));
        View::assign('pagination', $video['paginate']);
        View::assign('navTitle', $category);
        View::assign('checked', $orderBy);
        View::assign('total', $video['total']);

        return View::fetch('@pages/home/主题');
    }

    public function search($keyword = '')
    {
        $filters = Request::param('filter');
        $orderBy = $filters['order_by'] ?? 'popular';

        $searchVideo = DataService::searchVideos($this->lang, $filters, $keyword);

        
        if (!trim($keyword)) {
            $keyword = 'Popular';
        }
        View::assign('__RECOMMENDCATES__', DataService::getOtherCategories($this->lang));
        View::assign('pagination', $searchVideo['paginate']);
        View::assign('navTitle', $keyword);
        View::assign('checked', $orderBy);
        View::assign('total', $searchVideo['total']);

        return View::fetch('@pages/home/主题');
    }

    public function popular()
    {
        $filters = Request::param('filter');
        $orderBy = $filters['order_by'] ?? 'popular';

        $navTitle = 'Popular videos';
        $popurVideo = DataService::getPopularVideos($this->lang, $filters);

        View::assign('__RECOMMENDCATES__', DataService::getOtherCategories($this->lang));
        View::assign('pagination', $popurVideo['paginate']);

        View::assign('navTitle', $navTitle);
        View::assign('checked', $orderBy);
        View::assign('total', $popurVideo['total']);

        return View::fetch('@pages/home/主题');
    }

    public function new()
    {
        $filters = Request::param('filter');
        $orderBy = $filters['order_by'] ?? 'popular';

        $navTitle = 'New videos';
        $newVideo = DataService::getNewVideos($this->lang, $filters);

        View::assign('__RECOMMENDCATES__', DataService::getOtherCategories($this->lang));
        View::assign('pagination', $newVideo['paginate']);

        View::assign('navTitle', $navTitle);
        View::assign('checked', $orderBy);
        View::assign('total', $newVideo['total']);

        return View::fetch('@pages/home/主题');
    }

    public function rating()
    {
        $filters = Request::param('filter');
        $orderBy = $filters['order_by'] ?? 'popular';
        
        $navTitle = 'Top rated videos';
        $topRate = DataService::getTopRatedVideos($this->lang, $filters, 20);

        View::assign('__RECOMMENDCATES__', DataService::getOtherCategories($this->lang));
        View::assign('pagination', $topRate['paginate']);

        View::assign('navTitle', $navTitle);
        View::assign('checked', $orderBy);
        View::assign('total', $topRate['total']);
        
        
        return View::fetch('@pages/home/主题');
    }

    public function 主题()
    {
        echo 123123;exit;
        return View::fetch('@pages/home/主题');
    }

    public function pornstar($pornstar)
    {
        if ($pornstar) {
            $filters = Request::param('filter');
            $orderBy = $filters['order_by'] ?? 'popular';

            $video = DataService::getPstarVideoPaginate($this->lang, $filters, $pornstar);
    
            View::assign('__RECOMMENDCATES__', DataService::getOtherCategories($this->lang));
            View::assign('pagination', $video['paginate']);
            View::assign('navTitle', $pornstar);
            View::assign('total', $video['total']);
            View::assign('checked', $orderBy);

            return View::fetch('@pages/home/主题');
        }else{
            $res = DataService::getAllPstars($this->lang);

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
        $res = DataService::getAllCategories($this->lang);

        View::assign('navTitle', 'Categories');
        View::assign('__ALLSTARS__', $res);
        View::assign('keys', array_keys($res));
        return View::fetch('@pages/home/明星');
    }

    public function network($keyword = '')
    {
        if ($keyword) {
            View::assign('info', DataService::getPartnerByRouteName($this->lang, $keyword));
            return View::fetch('@pages/cooperate/合作详情');
        } else {

            View::assign('__NETWORKS__', DataService::getNetworks($this->lang));
            return View::fetch('@pages/cooperate/合作列表');
        }
    }

    public function listdata()
    {
        $data = $this->listdata;
        return json($data);
    }
}
