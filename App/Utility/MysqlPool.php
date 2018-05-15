<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/20
 * Time: 9:57
 */

namespace App\Utility;


use EasySwoole\Config;
use EasySwoole\Core\Swoole\Coroutine\AbstractInterface\CoroutinePool;
use EasySwoole\Core\Swoole\Coroutine\Client\Mysql;

class MysqlPool extends CoroutinePool
{

    function __construct($min, $max)
    {
        parent::__construct($min, $max);
    }

    protected function createObject()
    {
        $conf = Config::getInstance()->getConf('MYSQL');
        $db = new Mysql([
            'host' => $conf['HOST'],
            'username' => $conf['USER'],
            'password' => $conf['PASSWORD'],
            'db' => $conf['DB_NAME']
        ]);
        if (isset($conf['names'])) {
            $db->rawQuery('SET NAMES ' . $conf['names']);
        }
        return $db;
    }

    function getObj($timeOut = 0.1):?Mysql
    {
        return parent::getObj($timeOut);
    }

}