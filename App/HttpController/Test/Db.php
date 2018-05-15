<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/20
 * Time: 9:54
 */

namespace App\HttpController\Test;

use App\Http\Result;
use App\HttpController\BaseController;
use App\Service\ProductInfoService;
use App\Utility\MysqlPool;
use EasySwoole\Core\Http\Message\Status;
use EasySwoole\Core\Swoole\Coroutine\PoolManager;

class Db extends BaseController
{
    function index()
    {
        $this->response()->write('db test');
    }

    function coroutine()
    {
        $mysqlPool = PoolManager::getInstance()->getPool(MysqlPool::class);
        $mysql = $mysqlPool->getObj();
        $result = $mysql->rawQuery('select * from led_product_info');
        $mysqlPool->freeObj($mysql);
        $this->writeJsonWithNoCode(Status::CODE_OK, Result::makeSuccess(['data' => $result]));
    }

    function get()
    {
        try {
            ProductInfoService::getInstance()->query('awdsa');
        } catch (\RuntimeException $e) {
            $this->writeJsonWithNoCode(Status::CODE_OK,Result::makeError(1001,$e->getMessage()));
        }
    }

}