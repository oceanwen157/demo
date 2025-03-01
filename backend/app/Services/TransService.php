<?php

namespace App\Services;

use App\Models\QorCategories;
use App\Models\QorPstars;
use App\Models\QorSources;
use App\Models\QorVideos;
use Encore\Admin\Form;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Model;
use Kph\Helpers\StringHelper;
use Kph\Helpers\ValidateHelper;
use sqhlib\Hanzi\HanziConvert;
use DeepL\DeepLClient;
use DeepL\DeepLException;
use Throwable;

/**
 * 翻译服务
 */
class TransService extends ServiceBase
{


    /**
     * 语言对映射
     */
    const LANG_PAIR = [
        // 标识 -> 目标语言
        'en' => 'EN-US',
        'cn' => 'ZH',
        'tw' => 'ZH-HANS',
        'ja' => 'JA',
        'ko' => 'KO',
        'ms' => '',
        'th' => '',
        'de' => 'DE',
        'vi' => '',
        'id' => 'ID',
        'pt' => 'PT-PT',
        'tlph' => '',
    ];


    /**
     * 缓存前缀
     */
    const CACHE_PREFIX = 'trans:';


    /**
     * 标识转为目标语言
     * @param string $tag
     * @return string
     */
    public static function tag2Lang(string $tag): string
    {
        $res = self::LANG_PAIR[$tag] ?? '';
        return $res;
    }


    /**
     * 获取翻译API客户端
     * @return DeepLClient
     * @throws DeepLException
     */
    public static function getApiClient(): DeepLClient
    {
        //api申请地址：https://www.deepl.com/docs-api
        static $client;
        if (!$client) {
            $authKey = env('TRANS_API_KEY', '');
            $client = new DeepLClient($authKey);
        }

        return $client;
    }


    public static function transWords(string $words, string $langTag): string
    {
        $words = trim($words);
        $langTag = trim(strtolower($langTag));
        $targetLang = self::tag2Lang($langTag);
        if (empty($words) || empty($langTag) || empty($targetLang)) {
            return $words;
        }

        $key = self::CACHE_PREFIX . md5("{$langTag}:{$words}");
        $res = Redis::get($key);
        if (empty($res)) {
            $client = self::getApiClient();
            if ($langTag == 'tw') {
                //deepl不支持繁体,故要先转为简体
                $words = self::transWords($words, 'cn');

            }
//$res = HanziConvert::convert($str, true);
        }


        return $res;
    }


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
        $client = self::getApiClient();
        $all = $client->getTargetLanguages();
        var_dump($all);
    }


}
