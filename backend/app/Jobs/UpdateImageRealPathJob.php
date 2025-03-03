<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\QorDataService;
use Illuminate\Support\Facades\Log;

class UpdateImageRealPathJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $record;

    public function __construct($record)
    {
        $this->record = $record;
    }

    public function handle()
    {
        Log::info("-------update image url begin--------");
        try {
            $imageUrl = $this->record->cover_ori;
            $realPath = $this->processImage($imageUrl);
            
            if ($realPath) {
                $this->record->update([
                    'cover_new' => $realPath,
                ]);
            }
        } catch (\Exception $e) {
            Log::error("图片更新失败: {$e->getMessage()}");
        }
        
        Log::info("-------end--------");
    }

    private function processImage($url)
    {
        $data = [
            'sourceId' => md5(uniqid(mt_rand(), true)),
            'synchronous' => 1,
            'sourceUrl' => $url,
        ];
        $sign = QorDataService::makeUploadSign($data);

        $params = array_merge($data, ['sign' => $sign]);
        $res = QorDataService::curlPost(QorDataService::UPLOAD_IMG_API, $params);
        if (!empty($res[1])) {
            $arr = json_decode($res[1], 1);
            if (!empty($arr['data']['url'])) {
                return $arr['data']['url'];
            }
        }

        return '';
    }
}
