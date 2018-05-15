<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-5-14
 * Time: 13:58
 */

namespace App\Model;


use App\Bean\LiveMessage;

class LiveMessageModel extends AbstractBaseModel
{
    public function getSqlBean()
    {
        return LiveMessage::class;
    }

    /**
     * @param array $data
     * @return LiveMessage
     */
    function createSplBeanFromData(array $data)
    {
        return parent::createSplBeanFromData($data);
    }


}