<?php

namespace app\Services;

use app\model\Categories;
use app\model\Languages;
use app\model\Pstars;
use app\model\Sources;
use app\model\Videos;
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


    public static function getPopularCategories():array
    {

    }


    public static function getCategories()
    {

    }

    public static function getPstars()
    {

    }

    public static function getVideos()
    {
    }
}