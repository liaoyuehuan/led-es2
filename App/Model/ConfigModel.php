<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-5-16
 * Time: 17:33
 */

namespace App\Model;


use App\Bean\Config;

class ConfigModel extends AbstractBaseModel
{
    public function getSqlBean()
    {
        return Config::class;
    }

    /**
     * @param array $data
     * @return Config|null
     */
    public function createSplBeanFromData(array $data): ?Config
    {
        return parent::createSplBeanFromData($data); // TODO: Change the autogenerated stub
    }

}