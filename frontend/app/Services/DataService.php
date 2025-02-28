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

    public static function getAllCategories()
    {

    }

    public static function getAllPstars()
    {

    }

    public static function getVideos()
    {
    }

}