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

    const REQUEST_BATCH_SIZE = 1000;

    const MAX_CONCURRENT_REQUESTS = 10;

    protected $signature = 'crawler:run {mold} {--subject=}';

    private static $qorSvc;

    public function __construct()
    {
        parent::__construct();
        self::$qorSvc = new QorDataService();
    }

    public function handle()
    {
        ini_set('memory_limit', '-1');

        $mold = $this->argument('mold');
        $subject = $this->option('subject');
        try {
            self::handleData($mold, $subject);
        } catch (\Exception $e) {
            $this->error("Exception caught:\n");
            $this->error("Message: " . $e->getMessage() . "\n");
            $this->error("File: " . $e->getFile() . "\n");
            $this->error("Line: " . $e->getLine() . "\n");
            $this->error("Stack trace:\n" . $e->getTraceAsString() . "\n");
        }

        self::$qorSvc::updateImages();
    }

    private static function handleData($mold, $subject) {
        if (!$subject && $mold == 'cates') {
            self::addCates();
            return true;
        }

        if ($mold != 'video') {
            return false;
        }

        $subject = ($subject == 'pornstar') ? true : false;
        $categories = self::getCategories($mold);

        foreach($categories as $category) {
            $data = self::getPageVideos($category, true);
            foreach($data as $v) {
                try {
                    self::$qorSvc->addVideoInfo($v);
                } catch (\Exception $e) {
                    $this->error(sprintf(
                        "Pornstar Failed to add video info. Data: %s, Error: %s",
                        json_encode($v),
                        $e->getMessage()
                    ));
                }
            }
            sleep(1);
        }
    }

    private static function addCates()
    {
        // pornstar
        $categories = self::getCategories(1);
        foreach($categories as $category) {
            $gender = (strpos($category['title'], '♂') !== false) ? 1 : 0;
            self::$qorSvc->addPstar($category['title'], $category['href'], $category['count_badge'], $gender);
        }

        // categories
        $categories = self::getCategories();
        foreach($categories as $category) {
            self::$qorSvc->addCategory($category['title'], $category['href'], $category['count_badge'], intval($category['age_badge']));
        }
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

    public static function getAllCategoryVideosv2($categories, $star = false)
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
            //$maxPage = 1;
            $maxPage = self::detectMaxPage($html);

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
                'options' => ['delay' => rand(2000, 5000)],
                'fulfilled' => function ($response, $key) use (&$dataAll, $rules, $range, $star) {
                    $html = (string)$response->getBody();
                    $data = QueryList::Query($html, $rules, $range, '', 'utf-8')->data;
                    if (!empty($data)) {
                        foreach ($data as &$item) {
                            $arr = explode('_', $key);
                            
                            $item['routeOri'] = $arr[0];
                            $item['quantityDesc'] = $arr[3];
                            //$item['coverNew'] = self::getImgPath($item['coverOri']);
                            $item['coverNew'] = 'xxx';//self::getImgPath($item['coverOri']);
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

    public static function getAllCategoryVideos($categories, $star = false)
    {
        $dataAll = [];
        $client = new Client(['timeout' => 10, 'headers' => ['User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36']]);

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
            $maxPage = self::detectMaxPage($html);

            for ($page = 1; $page <= $maxPage; $page++) {
                $path = ($page == 1) ? $category['href'] : $category['href'] . "?page=$page";
                $url = self::BASE_URL . $path;

                $key = "{$category['href']}_{$category['title']}_{$category['age_badge']}_{$category['count_badge']}_{$page}";
                $allRequests[$key] = ['url' => $url, 'category' => $category, 'page' => $page, 'key' => $key]; // Store data for retry
            }
        }

        $batches = array_chunk($allRequests, self::REQUEST_BATCH_SIZE, true);
        foreach ($batches as $batchIndex => $batchRequests) {
            echo "Processing batch " . ($batchIndex + 1) . " of " . count($batches) . "\n";

            self::processBatch($batchRequests, $dataAll, $rules, $range, $star, $client);
        }

        return $dataAll;
    }

    private static function processBatch($batchRequests, &$dataAll, $rules, $range, $star, $client)
    {
        $requests = function () use ($batchRequests) {
            foreach ($batchRequests as $requestData) {
                yield $requestData['key'] => new Request('GET', $requestData['url']);
            }
        };

        $pool = new Pool($client, $requests(), [
            'concurrency' => self::MAX_CONCURRENT_REQUESTS,
            'options' => ['delay' => rand(3000, 7000)], // Increased delay
            'fulfilled' => function ($response, $key) use (&$dataAll, $rules, $range, $star, $batchRequests) {
                $html = (string)$response->getBody();
                $data = QueryList::Query($html, $rules, $range, '', 'utf-8')->data;
                if (!empty($data)) {
                    foreach ($data as &$item) {
                        $arr = explode('_', $key);

                        $item['routeOri'] = $arr[0];
                        $item['quantityDesc'] = $arr[3];
                        $item['coverNew'] = 'xxx';//self::getImgPath($item['coverOri']);

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
            'rejected' => function (\Exception $reason, $key) use (&$batchRequests, &$dataAll, $rules, $range, $star, $client) {
                echo "Failed to process {$key} \n";

                if ($reason instanceof \GuzzleHttp\Exception\RequestException) {
                    $response = $reason->getResponse();
                    if ($response) {
                        $code = $response->getStatusCode();
                    } else {
                        $code = 0;
                    }

                    if ($response && $code == 429) {
                        echo "Retrying {$key} after delay...\n";
                        sleep(15);
                        
                        $requestData = collect($batchRequests)->first(function ($value, $k) use ($key) {
                            return $value['key'] == $key;
                        });
                        if ($requestData) {
                            self::processBatch([$requestData], $dataAll, $rules, $range, $star, $client);
                        }
                    } else {
                        echo "Request {$key} rejected with code {$code}.\n";
                    }
                } else {
                    echo "Request {$key} permanently rejected due to connection or other error: " . $reason->getMessage() . "\n";
                }
            },
        ]);

        $promise = $pool->promise();
        $promise->wait();
    }

    public static function getPageVideos($category, $star = false)
    {
        $dataAll = [];
        $client = new Client(['timeout' => 10, 'headers' => ['User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36']]);

        $rules = [
            'durationDesc' => ['span.item-meta-container span.badge.float-right', 'text', '-span.font-bold.italic'],
            'coverOri' => ['img.item-image', 'src'],
            'source' => ['div.item-source-rating-container a.item-source', 'text', '-i'],
            'playUrl' => ['a.item-link.rate-link:first', 'href'],
            'title' => ['div.item-footer a.item-title', 'text']
        ];
        $range = '.content-block .cards-container .card';

        $allRequests = [];
        $firstPageUrl = sprintf(self::BASE_URL . $category['href']);
        $response = $client->get($firstPageUrl);
        $html = (string)$response->getBody();
        $maxPage = self::detectMaxPage($html);

        for ($page = 1; $page <= $maxPage; $page++) {
            $path = ($page == 1) ? $category['href'] : $category['href'] . "?page=$page";
            $url = self::BASE_URL . $path;

            $key = "{$category['href']}_{$category['title']}_{$category['age_badge']}_{$category['count_badge']}_{$page}";
            $allRequests[$key] = ['url' => $url, 'category' => $category, 'page' => $page, 'key' => $key]; // Store data for retry
        }


        $batches = array_chunk($allRequests, self::REQUEST_BATCH_SIZE, true);
        foreach ($batches as $batchIndex => $batchRequests) {
            echo "Processing batch " . ($batchIndex + 1) . " of " . count($batches) . "\n";

            self::processBatch($batchRequests, $dataAll, $rules, $range, $star, $client);
        }

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

        $maxPage = 100;
        if (!empty($data[0]['total']) && !empty($data[0]['pageSize'])) {
            $total = filter_var($data[0]['total'], FILTER_SANITIZE_NUMBER_INT);
            $pageSize = filter_var($data[0]['pageSize'], FILTER_SANITIZE_NUMBER_INT);

            if ($total && $pageSize) {
                $page = ceil(intval($total) / intval($pageSize));
                
                return $page > $maxPage ? $maxPage : $page;
            }
        }

        return 1;
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
}
