<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/24
 * Time: 11:48
 */

namespace App\HttpController\Test;


use App\Service\ProductInfoQueryRecordService;
use App\Utils\IpUtils;
use EasySwoole\Core\Http\AbstractInterface\Controller;
use EasySwoole\Core\Swoole\Task\TaskManager;

class Ip extends Controller
{
    function index()
    {
        $this->response()->write("ip");
    }

    public function geo()
    {
        $serverParams = $this->request()->getHeaders();
        $code = geoip_country_code_by_name($serverParams['remote_addr']);
        var_dump($serverParams);
        var_dump($code);
    }

    public function record()
    {
        $ip = IpUtils::getIp($this->request());
        TaskManager::async(function () use ($ip) {
            ProductInfoQueryRecordService::getInstance()->record('asdsads', $ip);
        });
    }
}