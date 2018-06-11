<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/24
 * Time: 13:44
 */

namespace App\Utils;


use EasySwoole\Core\Http\Request;
use EasySwoole\Core\Swoole\Coroutine\Client\Http;

class IpUtils
{
    public static function getIp(Request $request)
    {
        if ($request->getHeader('x-forwared-for')) {
            return $request->getHeader('x-forwared-for')[0];
        } else if ($request->getHeader('x-real-ip')) {
            return $request->getHeader('x-real-ip')[0];
        } else {
            return $request->getServerParams()['remote_addr'];
        };
    }

    public static function getCountryCodeByIp(string $ip)
    {
        if (false === extension_loaded('geoip')) {
            throw new \Exception('extension geoip not found');
        }
        return geoip_country_code_by_name($ip);
    }

    public static function getCountryCode(Request $request)
    {
        $ip = self::getIp($request);
        return self::getCountryCodeByIp($ip);
    }

    public static function getIpInfo($ip): ? array
    {
        $client = new Http('http://ip.taobao.com/service/getIpInfo.php');
        $client->setGet(['ip' => $ip]);
        $response = $client->exec();
        if (!empty($response['body'])){
            return json_decode($response['body'],true);
        } else {
            return  null;
        }
    }
}