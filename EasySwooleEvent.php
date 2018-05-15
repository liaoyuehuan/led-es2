<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/1/9
 * Time: 下午1:04
 */

namespace EasySwoole;

use App\Async\MySQL;
use App\Utility\MysqlPool;
use \EasySwoole\Core\AbstractInterface\EventInterface;
use EasySwoole\Core\Component\Di;
use EasySwoole\Core\Swoole\Coroutine\PoolManager;
use \EasySwoole\Core\Swoole\ServerManager;
use \EasySwoole\Core\Swoole\EventRegister;
use \EasySwoole\Core\Http\Request;
use \EasySwoole\Core\Http\Response;

Class EasySwooleEvent implements EventInterface
{

    public static function frameInitialize(): void
    {
        // TODO: Implement frameInitialize() method.
        date_default_timezone_set('Asia/Shanghai');
    }

    public static function mainServerCreate(ServerManager $server, EventRegister $register): void
    {
        PoolManager::getInstance()->addPool(MysqlPool::class);
        Di::getInstance()->set(MySQL::class,
            [
                'host' => Config::getInstance()->getConf('MYSQL.HOST'),
                'port' => Config::getInstance()->getConf('MYSQL.PORT'),
                'user' => Config::getInstance()->getConf('MYSQL.USER'),
                'password' => Config::getInstance()->getConf('MYSQL.PASSWORD'),
                'database' => Config::getInstance()->getConf('MYSQL.led_default_db'),
            ]
            , 20);
    }

    public static function onRequest(Request $request, Response $response): void
    {
        // TODO: Implement onRequest() method.
    }

    public static function afterAction(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}