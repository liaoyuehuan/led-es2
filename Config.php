<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2017/12/30
 * Time: 下午10:59
 */

return [
    'MAIN_SERVER' => [
        'HOST' => '0.0.0.0',
        'PORT' => 9501,
        'SERVER_TYPE' => \EasySwoole\Core\Swoole\ServerManager::TYPE_WEB_SERVER,
        'SOCK_TYPE' => SWOOLE_TCP,//该配置项当为SERVER_TYPE值为TYPE_SERVER时有效
        'RUN_MODEL' => SWOOLE_PROCESS,
        'SETTING' => [
            'task_worker_num' => 8, //异步任务进程
            'task_max_request' => 1000,
            'max_request' => 5000,//强烈建议设置此配置项
            'worker_num' => 8
        ],
    ],
    'DEBUG' => true,
    'TEMP_DIR' => EASYSWOOLE_ROOT . '/Temp',
    'LOG_DIR' => EASYSWOOLE_ROOT . '/Log',
    'EASY_CACHE' => [
        'PROCESS_NUM' => 1,//若不希望开启，则设置为0
        'PERSISTENT_TIME' => 0//如果需要定时数据落地，请设置对应的时间周期，单位为秒
    ],
    'CLUSTER' => [
        'enable' => false,
        'token' => null,
        'broadcastAddress' => ['255.255.255.255:9556'],
        'listenAddress' => '0.0.0.0',
        'listenPort' => 9556,
        'broadcastTTL' => 5,
        'serviceTTL' => 10,
        'serverName' => 'easySwoole',
        'serverId' => null
    ],
    'MYSQL' => [
        'HOST' => '172.18.69.167', // 数据库地址
        'PORT' => 3306, // 数据库端口
        'USER' => 'godafee_db', // 数据库用户名
        'PASSWORD' => 'God20170306', // 数据库密码
        'DB_NAME' => 'led_default_db', // 数据库库名
        'PREFIX' => 'led_',
        'MIN' => 5, // 最小连接数
        'MAX' => 100 // 最大连接数
    ],
    'EXTEND' => [
        'TOKEN' => 'e5c742a835d5c8f1e0cf33a989fe8669'
    ],
    'RESPONSE' => [
        'HEADER' => ['Content-Type','text/html;charset=utf-8']
    ]
];