<?php

namespace app\Services;

use app\model\Categories;
use app\model\Languages;
use app\model\Partners;
use app\model\Pstars;
use app\model\Sources;
use app\model\Videos;
use Kph\Helpers\ValidateHelper;
use think\facade\Db;
use think\facade\Cache;
use think\Model;
use think\model\Collection;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

/**
 * 数据服务
 */
class DataService extends ServiceBase
{
    const ORIGIN_BASE_URL = 'https://www.qorno.com';

    public static function getRedirectUrl($url)
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => self::ORIGIN_BASE_URL . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            CURLOPT_NOBODY => true
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('Curl error: ' . curl_error($ch));
        }

        $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $url = '';
        if ($httpCode == 200 && !empty($finalUrl)) {
            if (strpos($finalUrl, self::ORIGIN_BASE_URL) !== false) {
                return $url;
            }
            $url = $finalUrl;
        }

        return $url;
    }


    /**
     * 字母集合
     */
    const LETTERS = [
        '#',
        'A',
        'B',
        'C',
        'D',
        'E',
        'F',
        'G',
        'H',
        'I',
        'J',
        'K',
        'L',
        'M',
        'N',
        'O',
        'P',
        'Q',
        'R',
        'S',
        'T',
        'U',
        'V',
        'W',
        'X',
        'Y',
        'Z',
    ];


    /**
     * 多语言标题字段
     */
    const MUL_LANG_FIELD = [
        'title_en',
        'title_cn',
        'title_tw',
        'title_ja',
        'title_ko',
        'title_ms',
        'title_th',
        'title_de',
        'title_vi',
        'title_id',
        'title_pt',
        'title_tlph',
    ];


    /**
     * 初始化字母集合
     * @return array
     */
    public static function initLettersMap(): array
    {
        $res = [];
        foreach (self::LETTERS as $letter) {
            $res[$letter] = [];
        }

        return $res;
    }


    /**
     * 初始化分页结果
     * @param int $limit
     * @return array
     */
    public static function initPaginateResult(int $limit): array
    {
        return [
            'paginate' => null, //tp的paginate方法结果
            'total' => 0, //总记录数
            'limit' => 0, //每页数量
        ];
    }


    /**
     * 获取语言列表
     * @return Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getLanguages(): Collection
    {
        $res = Languages::field('id,tag,code,title,path')->order('sort', 'asc')->select();
        return $res;
    }


    /**
     * 获取来源列表
     * @return Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getSources(): Collection
    {
        $res = Sources::field('*')->whereIn('is_hot', [0, 1])->order('sort', 'asc')->select();
        return $res;
    }


    /**
     * 获取顶部N个推荐分类
     * @param int $limit 数量
     * @return Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getTopCategories(int $limit = 8): Collection
    {
        $res = Categories::field('*')
            ->order('is_hot', 'desc')
            ->order('quantity_num', 'desc')
            ->order('sort', 'asc')
            ->order('id', 'asc')
            ->limit($limit)->select();

        return $res;
    }


    /**
     * 获取顶部N个推荐明星
     * @param int $limit 数量
     * @return Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getTopPstars(int $limit = 8): Collection
    {
        $res = Pstars::field('*')->order('is_hot', 'desc')->order('sort', 'asc')->order('id', 'asc')->limit($limit)->select();
        return $res;
    }


    /**
     * 获取首页其他推荐的分类(非顶部分类)
     * @param int $limit 数量
     * @return Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getOtherCategories(int $limit = 20): Collection
    {
        $tops = self::getTopCategories($limit);
        $topIds = [0];
        foreach ($tops as $top) {
            $topIds[] = $top->id;
        }

        $res = Categories::whereNotIn('id', $topIds)->order('is_hot', 'desc')->order('sort', 'asc')->limit($limit)->select();
        return $res;
    }


    /**
     * 获取流行的分类,结果结构如 []Collection, 其中数组键为大写字母
     * @param bool $isHot 是否热门
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getPopularCategories(bool $isHot = false): array
    {
        $res = self::initLettersMap();
        $qry = Categories::order('is_hot', 'desc')->order('sort', 'asc');
        if ($isHot) {
            $qry->where('is_hot', 1);
        }

        //结果分组
        $rows = $qry->limit(10000)->select();
        foreach ($rows as $row) {
            $letter = substr(($row->title_en ?? ''), 0, 1);
            $letter = strtoupper($letter);
            if (ValidateHelper::isAlpha($letter)) {
                $res[$letter][] = $row;
            } else {
                $res['#'][] = $row;
            }
        }

        return $res;
    }


    /**
     * 获取流行的明星,结果结构如 []Collection, 其中数组键为大写字母
     * @param bool $isHot 是否热门
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getPopularPstars(bool $isHot = false): array
    {
        $res = self::initLettersMap();
        $qry = Pstars::order('is_hot', 'desc')->order('sort', 'asc');
        if ($isHot) {
            $qry->where('is_hot', 1);
        }

        //结果分组
        $rows = $qry->limit(10000)->select();
        foreach ($rows as $row) {
            $letter = substr(($row->title_en ?? ''), 0, 1);
            $letter = strtoupper($letter);
            if (ValidateHelper::isAlpha($letter)) {
                $res[$letter][] = $row;
            } else {
                $res['#'][] = $row;
            }
        }

        return $res;
    }


    /**
     * 获取全部分类,结果结构如 []Collection, 其中数组键为大写字母
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getAllCategories(): array
    {
        $res = self::initLettersMap();
        $qry = Categories::order('is_hot', 'desc')->order('sort', 'asc');

        //结果分组
        $rows = $qry->select();
        foreach ($rows as $row) {
            $letter = substr(($row->title_en ?? ''), 0, 1);
            $letter = strtoupper($letter);
            if (ValidateHelper::isAlpha($letter)) {
                $res[$letter][] = $row;
            } else {
                $res['#'][] = $row;
            }
        }

        return $res;
    }


    /**
     * 获取全部明星,结果结构如 []Collection, 其中数组键为大写字母
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getAllPstars()
    {
        $res = self::initLettersMap();
        $qry = Pstars::order('is_hot', 'desc')->order('sort', 'asc');

        //结果分组
        $rows = $qry->select();
        foreach ($rows as $row) {
            $letter = substr(($row->title_en ?? ''), 0, 1);
            $letter = strtoupper($letter);
            if (ValidateHelper::isAlpha($letter)) {
                $res[$letter][] = $row;
            } else {
                $res['#'][] = $row;
            }
        }

        return $res;
    }


    /**
     * 根据路由获取某分类的视频分页列表
     * @param string $route 路由
     * @param string $source 来源
     * @param int $size 每页数量
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getCategoryVideoPaginate(string $route, string $source = '', int $size = 120): array
    {
        if ($size <= 0) {
            $size = 120;
        }
        $res = self::initPaginateResult($size);

        $route = trim($route);
        if (empty($route)) {
            return $res;
        }

        $cate = Categories::where('route_path', $route)->find();
        if (!$cate) {
            return $res;
        }

        $qry = Db::name('videos')->order('id', 'desc')->where('cid', $cate->id);
        $source = trim($source);
        if (!empty($source)) {
            $qry->where('source', $source);
        }

        $pagination = $qry->paginate($size);
        $res = [
            'paginate' => $pagination,
            'total' => $pagination->total(),
            'limit' => $size,
        ];

        return $res;
    }


    /**
     * 根据路由获取某明星的视频分页列表
     * @param string $route 路由
     * @param string $source 来源
     * @param int $size 每页数量
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getPstarVideoPaginate(string $route, string $source = '', int $size = 120): array
    {
        if ($size <= 0) {
            $size = 120;
        }
        $res = self::initPaginateResult($size);

        $route = trim($route);
        if (empty($route)) {
            return $res;
        }

        $star = Pstars::where('route_path', $route)->find();
        if (!$star) {
            return $res;
        }

        $qry = Db::name('videos')->order('id', 'desc')->where('pid', $star->id);
        $source = trim($source);
        if (!empty($source)) {
            $qry->where('source', $source);
        }

        $pagination = $qry->paginate($size);
        $res = [
            'paginate' => $pagination,
            'total' => $pagination->total(),
            'limit' => $size,
        ];

        return $res;
    }


    /**
     * 根据关键词搜索分类
     * @param string $keyword
     * @return Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getCategoriesByLike(string $keyword): Collection
    {
        $fields = self::MUL_LANG_FIELD;
        array_push($fields, 'route_path');
        $searchFields = implode('|', $fields);
        $res = Categories::where($searchFields, 'like', "%{$keyword}%")->select();

        return $res;
    }


    /**
     * 根据关键词搜索明星
     * @param string $keyword
     * @return Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getPstarsByLike(string $keyword): Collection
    {
        $fields = self::MUL_LANG_FIELD;
        array_push($fields, 'route_path');
        $searchFields = implode('|', $fields);
        $res = Pstars::where($searchFields, 'like', "%{$keyword}%")->select();

        return $res;
    }


    /**
     * 根据关键词搜索视频列表
     * @param string $keyword 关键词
     * @param int $size 每页数量
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function searchVideos(string $keyword = '', int $size = 120): array
    {
        if ($size <= 0) {
            $size = 120;
        }
        $res = self::initPaginateResult($size);

        $qry = Db::name('videos');

        $keyword = trim($keyword);
        if (!empty($keyword)) {
            $orWheres = []; //多个or

            $cateIds = [];
            $cates = self::getCategoriesByLike($keyword);
            if ($cates) {
                foreach ($cates as $cate) {
                    $cateIds[] = $cate->id;
                }
            }
            if (!empty($cateIds)) {
                $orWheres[] = ['cid', 'in', $cateIds];
            }

            $starIds = [];
            $stars = self::getPstarsByLike($keyword);
            if ($stars) {
                foreach ($stars as $star) {
                    $starIds[] = $star->id;
                }
            }
            if (!empty($starIds)) {
                $orWheres[] = ['pid', 'in', $starIds];
            }

            //视频本身的搜索
            $fields = self::MUL_LANG_FIELD;
            foreach ($fields as $field) {
                $orWheres[] = [$field, 'like', '%' . $keyword . '%'];
            }

            $qry->where(function ($query) use ($orWheres) {
                $query->whereOr($orWheres);
            });
        }

        $pagination = $qry->order('id', 'desc')->paginate($size);
        $res = [
            'paginate' => $pagination,
            'total' => $pagination->total(),
            'limit' => $size,
        ];

        return $res;
    }


    /**
     * 获取流行的视频分页列表
     * @param int $size 每页数量
     * @return array
     * @throws DbException
     */
    public static function getPopularVideos(int $size = 120): array
    {
        if ($size <= 0) {
            $size = 120;
        }

        $qry = Db::name('videos')->where('vote_num', '>', 45)->order('id', 'desc');
        $pagination = $qry->paginate($size);
        $res = [
            'paginate' => $pagination,
            'total' => $pagination->total(),
            'limit' => $size,
        ];

        return $res;
    }


    /**
     * 获取最新的视频分页列表
     * @param int $size 每页数量
     * @return array
     * @throws DbException
     */
    public static function getNewVideos(int $size = 120): array
    {
        if ($size <= 0) {
            $size = 120;
        }

        $qry = Db::name('videos')->order('id', 'desc');
        $pagination = $qry->paginate($size);
        $res = [
            'paginate' => $pagination,
            'total' => $pagination->total(),
            'limit' => $size,
        ];

        return $res;
    }


    /**
     * 获取高分的视频分页列表
     * @param int $size 每页数量
     * @return array
     * @throws DbException
     */
    public static function getTopRatedVideos(int $size = 120): array
    {
        if ($size <= 0) {
            $size = 120;
        }

        $qry = Db::name('videos')->where('vote_num', '>', 80)->order('id', 'desc');
        $pagination = $qry->paginate($size);
        $res = [
            'paginate' => $pagination,
            'total' => $pagination->total(),
            'limit' => $size,
        ];

        return $res;
    }


    /**
     * 获取首页推荐视频(每个分类对应一个视频),带缓存.数组元素结构如
     * $res[] = [
     * 'category' => $cate, //分类信息
     * 'video' => $video, //视频信息
     * ];
     * @param int $size 视频数
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function getHomeVideos(int $size = 120): array
    {
        $key = __FUNCTION__ . $size;
        $res = Cache::store('redis')->get($key);
        if (empty($res)) {
            $res = [];
            $cates = self::getTopCategories($size);
            foreach ($cates as $cate) {
                $video = Videos::where('cid', $cate->id)->order('vote_num')->find();
                if (!empty($video)) {
                    $res[] = [
                        'category' => $cate, //分类信息
                        'video' => $video, //视频信息
                    ];
                }
            }

            if (!empty($res)) {
                Cache::store('redis')->set($key, $res, 7200);
            }
        }

        return $res;
    }

    public static function getNetworks()
    {
        return Db::name('partners')->select();
    }


    /**
     * 根据路由获取合作伙伴
     * @param string $route
     * @return Array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getPartnerByRouteName(string $route): Array
    {
        return Db::name('partners')->where('route_path', $route)->find();
    }
}