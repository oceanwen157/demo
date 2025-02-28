<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use QL\QueryList;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use App\Services\QorDataService;

class Crawler extends Command
{
    const BASE_URL = 'https://www.qorno.com';

    const REQUEST_BATCH_SIZE = 5000;

    const MAX_CONCURRENT_REQUESTS = 20;

    const UPLOAD_IMG_API = 'https://upload-outside.yesebo.net/api/system/image';

    const UPLOAD_SIGN_KEY = '8ThqREd2YlAB7zIvGp1dOhlRvdz956jd';

    protected $signature = 'crawler:run';

    private static $qorSvc;

    public function __construct()
    {
        parent::__construct();
        self::$qorSvc = new QorDataService();
    }

    public function handle()
    {
        //var_dump(self::getImgPath());exit;
        $data = self::getAllCategoryVideos(
            [
                [
                    'href' => '/category/10-inch-cock',
                    'title' => '10+ Inch Cock',
                    'age_badge' => '',
                    'count_badge' => '581K'
                ]
            ]
        );

        foreach($data as $v) {
            var_dump(self::$qorSvc->addVideoInfo($v));
        }

        exit;
        
        //self::$qorSvc->addCategory();
        //var_dump(self::getImgPath());
        //var_dump(self::getPornstars());
        //var_dump(self::getRedirectUrl('https://www.qorno.com/out/?l=3AASPM4TEyRnq0huT2lGQlBsTkhTAtmOaHR0cHM6Ly93d3cuNHdhbmsuY29tL3ZpZGVvcy8xNDE0MzEvaS1tLWdvaW5nLXRvLWdpdmUteW91LW15LWJ1dHQtdG9kYXkvP3V0bV9zb3VyY2U9YXdtJnV0bV9tZWRpdW09YXdtdHJhZmZpYyZ1dG1fY2FtcGFpZ249NHdhbmsmc3ViaWQxPTcwMDAwMc0DpKJ0YwHNCCKncG9wdWxhcs0DQNkweyJhbGwiOiIiLCJvcmllbnRhdGlvbiI6InN0cmFpZ2h0IiwicHJpY2luZyI6IiJ9zQT1zme8sdaoY2F0ZWdvcnnOAAjXIsDZfFt7IjEiOiJyWXQyVnRlcDVVWSJ9LHsiMiI6IlBxSHE3emxaSDhDIn0seyIzIjoiT0ZwbndJUXFXYncifSx7Ii0xIjoiSllvdFd5UFV1SGcifSx7Ii0yIjoiRlVGTmNaeEpFUTAifSx7Ii0zIjoiNDlrRFNLTE81M1QifV0%3D&c=ddb6f8f4&v=3&'));
        var_dump(self::getAllCategoryVideos(
            [
                [
                    'href' => '/category/10-inch-cock',
                    'title' => '10+ Inch Cock',
                    'age_badge' => '',
                    'count_badge' => '581K'
                ]
            ]
        ));
        //var_dump(self::getCategoryVideos());
        //var_dump(self::getCategories());
    }

    public static function getCategories($star = false)
    {
        $path = $star ? '/pornstar' : '/a-z';
        $rules = [
            'href' => ['a.anchor-link', 'href'],
            'title' => ['span.category-title', 'text'],
            'badges' => ['span.badge-xsm', 'text', '', function ($content) {
                return $content;
            }]
        ];
    
    
        return QueryList::Query(self::BASE_URL . $path, $rules, '.category')->getData(function ($item) {
            $badges = $item['badges'];
            $age_badge = '';
            $count_badge = '';
    
            if (is_array($badges)) {
                if (count($badges) > 1) {
                    $age_badge = $badges[0];
                    $count_badge = $badges[1];
                } else {
                    $count_badge = $badges[0];
                }
            } elseif (is_string($badges)) {
                if (strpos($badges, '18+') === 0) {
                    $age_badge = '18+';
                    $count_badge = trim(str_replace('18+', '', $badges));
                } else {
                    $count_badge = $badges;
                }
            }
    
            return [
                'href' => $item['href'],
                'title' => $item['title'],
                'age_badge' => $age_badge,
                'count_badge' => $count_badge
            ];
        });

        // return  array_map(function ($item) {
        //     return trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($item['category'])), '-');
        // }, $data);
    }

    public static function getAllCategoryVideos($categories, $star = false)
    {
        $dataAll = [];
        $client = new Client(['timeout' => 10]);

        $rules = [
            'durationDesc' => ['span.item-meta-container span.badge.float-right', 'text', '-span.font-bold.italic'],
            'coverOri' => ['img.item-image', 'src'],
            'source' => ['div.item-source-rating-container a.item-source', 'text', '-i'],
            'playUrl' => ['a.item-link.rate-link:first', 'href'],
            'title' => ['div.item-footer a.item-title', 'text']
        ];
        $range = '.content-block .cards-container .card';

        $allRequests = [];
        foreach ($categories as $category) {
            $firstPageUrl = sprintf(self::BASE_URL . $category['href']);
            $response = $client->get($firstPageUrl);
            $html = (string)$response->getBody();
            $maxPage = 1;//self::detectMaxPage($html);

            for ($page = 1; $page <= $maxPage; $page++) {
                $path = ($page == 1) ? $category['href'] : $category['href']."?page=$page";
                $url = self::BASE_URL . $path;
                
                $key = "{$category['href']}_{$category['title']}_{$category['age_badge']}_{$category['count_badge']}_{$page}";
                $allRequests[$key] = new Request('GET', $url);
            }
        }

        $batches = array_chunk($allRequests, self::REQUEST_BATCH_SIZE, true);
        foreach ($batches as $batchIndex => $batchRequests) {
            echo "Processing batch " . ($batchIndex + 1) . " of " . count($batches) . "\n";

            $requests = function () use ($batchRequests) {
                foreach ($batchRequests as $key => $request) {
                    yield $key => $request;
                }
            };

            $pool = new Pool($client, $requests(), [
                'concurrency' => self::MAX_CONCURRENT_REQUESTS,
                'options' => ['delay' => rand(100, 500)],
                'fulfilled' => function ($response, $key) use (&$dataAll, $rules, $range, $star) {
                    $html = (string)$response->getBody();
                    $data = QueryList::Query($html, $rules, $range, '', 'utf-8')->data;
                    if (!empty($data)) {
                        foreach ($data as &$item) {
                            $arr = explode('_', $key);
                            
                            $item['routeOri'] = $arr[0];
                            $item['quantityDesc'] = $arr[3];
                            $item['coverNew'] = self::getImgPath($item['coverOri']);
                            //$item['playUrl'] = self::getRedirectUrl(self::BASE_URL.$item['playUrl']);
                            
                            if ($star) {
                                $item['star'] = $arr[1];
                                $item['gender'] = (strpos($arr[1], '♂') !== false) ? 1 : 0;
                            } else {
                                $item['category'] = $arr[1];
                                $item['ageLimit'] = intval($arr[2]);
                            }
                        }

                        $dataAll = array_merge($dataAll, $data);
                    }

                    echo "Processed {$key}, total items: " . count($dataAll) . "\n";
                },
                'rejected' => function (RequestException $reason, $key) {
                    echo "Failed to process {$key}: " . $reason->getMessage() . "\n";
                },
            ]);

            $promise = $pool->promise();
            $promise->wait();
        }

        return $dataAll;
    }

    public static function getCurrentPageCategoryVideos()
    {
        $path = '/category/%s';
        $url = sprintf(self::BASE_URL.$path, '10-inch-cock');

        $rules = [
            'duration' => ['span.item-meta-container span.badge.float-right', 'text', '-span.font-bold.italic'],
            'cover_image' => ['img.item-image', 'src'],
            'source' => ['div.item-source-rating-container a.item-source', 'text', '-i'],
            'play_link' => ['a.item-link.rate-link:first', 'href'],
            'title' => ['div.item-footer a.item-title', 'text']
        ];

        $range = '.content-block .cards-container .card';

        $maxPage =2;//100;
        $dataAll = [];
        $client = new Client([
            'timeout' => 10
        ]);
        $requests = function($total) use ($path) {
            for ($page = 2; $page <= $total; $page++) {
                //$url = self::BASE_URL . $path . '/' . $page;
                $url = sprintf(self::BASE_URL.$path, '10-inch-cock');
                //$url = sprintf(self::BASE_URL.$path, '10-inch-cock') . '?page=' . $page;
                yield $page => new Request('GET', $url);
            }
        };

        $pool = new Pool($client, $requests($maxPage), [
            'concurrency' => 10,
            'fulfilled' => function($response, $page) use (&$dataAll, $rules, $range) {
                $html = (string)$response->getBody();
                $data = QueryList::Query($html, $rules, $range, '', 'utf-8')->data;
                $dataAll = array_merge($dataAll, $data);
                
                var_dump(count($dataAll), $dataAll[0]);
                //usleep(0.2 * 1000000);
            },
            'rejected' => function(RequestException $reason, $page) {
                echo "Failed to process page {$page}: " . $reason->getMessage() . "\n";
            },
        ]);

        $promise = $pool->promise();
        $promise->wait();

        return $dataAll;
    }

    public static function getRedirectUrl($url)
    {
        $ch = curl_init();
        
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
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
        
        // 获取最终URL
        $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
        
        return [
            'final_url' => $finalUrl,
            'http_code' => $httpCode
        ];
    }

    private static function detectMaxPage(string $html)
    {
        $rules = [
            'total' => ['.pagination-summary', 'data-total'],
            'pageSize' => ['.pagination-summary', 'data-last'],
        ];
        $data = QueryList::Query($html, $rules)->data;

        $totalPage = 500;
        if (!empty($data[0]['total']) && !empty($data[0]['pageSize'])) {
            $total = filter_var($data[0]['total'], FILTER_SANITIZE_NUMBER_INT);
            $pageSize = filter_var($data[0]['pageSize'], FILTER_SANITIZE_NUMBER_INT);

            if ($total && $pageSize) {
                return ceil(intval($total) / intval($pageSize));
            }
        }

        return $totalPage;
    }

    public static function makeUploadSign($array, $signKey = ''): string
    {
        if (empty($array)) {
            return '';
        }
        ksort($array);

        $arr_temp = array();
        foreach ($array as $key => $val) {
            if ($key == 'data') {
                $valTemp = str_replace(' ', '+', $val);
                $arr_temp[] = $key . '=' . $valTemp;
            } else {
                $arr_temp[] = $key . '=' . $val;
            }
        }
        $string = implode('&', $arr_temp);

        if (empty($signKey)) {
            $signKey = self::UPLOAD_SIGN_KEY;
        }
        $string = $string . $signKey;

        $res = md5(hash('sha256', $string));

        return $res;
    }

    public static function getImgPath($url)
    {
        $data = [
            'sourceId' => md5(uniqid(mt_rand(), true)),
            'synchronous' => 1,
            'sourceUrl' => $url,
        ];
        $sign = self::makeUploadSign($data);

        $params = array_merge($data, ['sign' => $sign]);
        $res = self::curlPost(self::UPLOAD_IMG_API, $params);
        if (!empty($res[1])) {
            $arr = json_decode($res[1], 1);
            if (!empty($arr['data']['url'])) {
                return $arr['data']['url'];
            }
        }

        return '';
    }

    public static function curlPost(string $url, array $params, int $timeout = 60): array
    {
        $res = [];
        if (empty($url)) {
            return $res;
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $response = curl_exec($ch);
        $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch)) {
            return [$code, ''];
        }

        @curl_close($ch);
        $resp = strval($response);
        //var_dump('--------------curl req:', $url, $params);
        //var_dump('--------------curl res:', $code, $resp);

        return [$code, $resp];
    }
}
