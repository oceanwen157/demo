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