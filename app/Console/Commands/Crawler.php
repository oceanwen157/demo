<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use QL\QueryList;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class Crawler extends Command
{
    const BASE_URL = 'https://www.qorno.com';

    const IMG_API = 'https://upload-movie-outside.yesebo.net/?mod=index&code=imageUpload';

    const REQUEST_BATCH_SIZE = 5000;

    const MAX_CONCURRENT_REQUESTS = 20;

    const REQUEST_DELAY = 0.2;

    protected $signature = 'crawler:run';


    public function __construct()
    {
        parent::__construct();
    }

    public static function getCategorys()
    {
        $path = '/a-z';
        $rules = [
            'category' => [
                '.category-group .category-title',
                'text'
            ]
        ];
        
        $data = QueryList::Query(self::BASE_URL.$path, $rules)->data;

        return  array_map(function ($item) {
            return $item['category'];
        }, $data);
    }

    public static function getAllCategoryVideos($categories)
    {
        $dataAll = [];
        $client = new Client(['timeout' => 10]);

        $rules = [
            'duration' => ['span.item-meta-container span.badge.float-right', 'text', '-span.font-bold.italic'],
            'cover_image' => ['img.item-image', 'src'],
            'source' => ['div.item-source-rating-container a.item-source', 'text', '-i'],
            'play_link' => ['a.item-link.rate-link:first', 'href'],
            'title' => ['div.item-footer a.item-title', 'text']
        ];
        $range = '.content-block .cards-container .card';

        $allRequests = [];
        foreach ($categories as $category) {
            $firstPageUrl = sprintf(self::BASE_URL . '/category/%s', $category);
            $response = $client->get($firstPageUrl);
            $html = (string)$response->getBody();
            $maxPage = self::detectMaxPage($html);

            for ($page = 1; $page <= $maxPage; $page++) {
                $path = ($page == 1) ? '/category/%s' : '/category/%s?page=%d';
                $url = sprintf(self::BASE_URL . $path, $category, $page);
                
                $key = "{$category}_page_{$page}";
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
                'fulfilled' => function ($response, $key) use (&$dataAll, $rules, $range) {
                    $html = (string)$response->getBody();
                    $data = QueryList::Query($html, $rules, $range, '', 'utf-8')->data;
                    if (!empty($data)) {
                        foreach ($data as &$item) {
                            [$category] = explode('_page_', $key);
                            $item['category'] = $category;
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

    public function handle()
    {
        var_dump(self::getRedirectUrl('https://www.qorno.com/out/?l=3AASPM4TEyRnq0huT2lGQlBsTkhTAtmOaHR0cHM6Ly93d3cuNHdhbmsuY29tL3ZpZGVvcy8xNDE0MzEvaS1tLWdvaW5nLXRvLWdpdmUteW91LW15LWJ1dHQtdG9kYXkvP3V0bV9zb3VyY2U9YXdtJnV0bV9tZWRpdW09YXdtdHJhZmZpYyZ1dG1fY2FtcGFpZ249NHdhbmsmc3ViaWQxPTcwMDAwMc0DpKJ0YwHNCCKncG9wdWxhcs0DQNkweyJhbGwiOiIiLCJvcmllbnRhdGlvbiI6InN0cmFpZ2h0IiwicHJpY2luZyI6IiJ9zQT1zme8sdaoY2F0ZWdvcnnOAAjXIsDZfFt7IjEiOiJyWXQyVnRlcDVVWSJ9LHsiMiI6IlBxSHE3emxaSDhDIn0seyIzIjoiT0ZwbndJUXFXYncifSx7Ii0xIjoiSllvdFd5UFV1SGcifSx7Ii0yIjoiRlVGTmNaeEpFUTAifSx7Ii0zIjoiNDlrRFNLTE81M1QifV0%3D&c=ddb6f8f4&v=3&'));
        //var_dump(self::getAllCategoryVideos(['10-inch-cock']));
        //var_dump(self::getCategoryVideos());
        //var_dump(self::getCategorys());
        //$this->info("Hello World!");
        return 0;
    }
}
