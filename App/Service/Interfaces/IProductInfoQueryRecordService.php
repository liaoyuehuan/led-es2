<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/24
 * Time: 14:10
 */

namespace App\Service\Interfaces;


interface IProductInfoQueryRecordService
{
    /**
     * @param string $snCode
     * @param string $ip
     * @return mixed
     */
    function record(string $snCode, string $ip): bool;
}