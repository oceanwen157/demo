<?php

namespace app\Services;


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
            CURLOPT_URL => self::ORIGIN_BASE_URL.$url,
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

}