<?php

namespace app\Services;

use app\model\Categories;
use app\model\Languages;
use app\model\Pstars;
use app\model\Sources;
use app\model\Videos;
use Kph\Helpers\ValidateHelper;
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
            'paginate' => [], //tp模型的paginate方法结果
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
        $res = Categories::field('*')->order('is_hot', 'desc')->order('sort', 'asc')->order('id', 'asc')->limit($limit)->select();
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
     * @param int $size 每页数量
     * @param int $page
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getCategoryVideoPaginate(string $route, int $size = 120, int $page = 1): array
    {
        if ($page <= 0) {
            $page = 1;
        }
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

        $pagination = Db::name('videos')->where('cid', $cate->id)->paginate($size);
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
     * @param int $size 每页数量
     * @param int $page
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getPstarVideoPaginate(string $route, int $size = 120, int $page = 1): array
    {
        if ($page <= 0) {
            $page = 1;
        }
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

        $pagination = Db::name('videos')->where('pid', $star->id)->paginate($size);
        $res = [
            'paginate' => $pagination,
            'total' => $pagination->total(),
            'limit' => $size,
        ];

        return $res;
    }


    public static function searchVideos(string $keyword = '', int $size = 120, int $page = 1): array
    {
        return [];
    }


    public static function getVideos()
    {
    }

}