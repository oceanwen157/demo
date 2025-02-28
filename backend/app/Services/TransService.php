<?php

namespace App\Services;

use App\Models\QorCategories;
use App\Models\QorPstars;
use App\Models\QorSources;
use App\Models\QorVideos;
use Encore\Admin\Form;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Kph\Helpers\StringHelper;
use Kph\Helpers\ValidateHelper;
use Throwable;

/**
 * 翻译服务
 */
class TransService extends ServiceBase
{

    /**
     * 翻译分类
     * @return int
     */
    public static function transCategories(): int
    {
        return 0;
    }


    /**
     * 翻译明星
     * @return int
     */
    public static function transPstars(): int
    {
        return 0;
    }


    /**
     * 翻译视频
     * @return int
     */
    public static function transVideos(): int
    {
        return 0;
    }


    /**
     * 执行翻译
     * @return void
     */
    public function doTranslate(): void
    {

    }


}
