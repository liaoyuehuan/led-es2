<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-5-16
 * Time: 17:36
 */

namespace App\Service;


use App\Bean\Config;
use App\Consts\CacheConst;
use App\Model\ConfigModel;
use App\Service\Interfaces\IConfigService;
use EasySwoole\Core\Component\Cache\Cache;
use EasySwoole\Core\Swoole\Coroutine\Client\Mysql;

class ConfigService extends AbstractService implements IConfigService
{

    /**
     * @var ConfigModel
     */
    private $configModel;

    public function __construct()
    {
        $this->configModel = ConfigModel::getInstance();
    }

    /**
     * @return string | null
     */
    function getOperationStatement()
    {
        $bean = $this->getByName('operation_statement');
        return $bean ? $bean->getValue() : '';
    }

    function getOperationStatementHtml(): ?string
    {
        $img_host = 'http://apis.ledpropeller.com';
        $content = preg_replace('/(?<=src\=\")(?=\/)/', $img_host, $this->getOperationStatement());
        return $content;
    }


    /**
     * @param string $name
     * @return Config|null
     */
    function getByName(string $name)
    {
        $cacheKey = 'config-' . $name;
//        $data = Cache::getInstance()->get($cacheKey, CacheConst::CACHE_EXPIRE_SECOND);
        if (empty($data)) {
            $data = json_encode($this->configModel->getOne(function (Mysql $db) {
                $db->where('name', 'operation_statement');
            }));
            Cache::getInstance()->set($cacheKey, $data);
        }
        return $this->configModel->createSplBeanFromData(json_decode($data, true));
    }

}