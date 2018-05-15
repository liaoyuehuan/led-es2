<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/15/015
 * Time: 15:49
 */

namespace App\Service;


use App\Http\LimitParam;

abstract class AbstractService
{
    /**
     * @var static
     */
    protected static $instance;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (!isset(static::$instance[static::class])) {
            static::$instance[static::class] = new static();
        }
        return static::$instance[static::class];
    }

    /**
     * @param array $param
     * @return LimitParam
     */
    protected function getLimitParamFromParam(array $param = []){
        $limitParam = new LimitParam();
        if(!empty($param['page']) && $param['page'] > 0) $limitParam->page = $param['page'];
        if(!empty($param['page_size']) && $param['page'] > 0) $limitParam->limit = $param['page_size'];
        return $limitParam;
    }
}