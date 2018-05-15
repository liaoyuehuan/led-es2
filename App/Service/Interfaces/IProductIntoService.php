<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/20
 * Time: 11:00
 */

namespace App\Service\Interfaces;


use App\Bean\ProductInfo;

interface IProductIntoService
{
    /**
     * 查询的同时会增加请求查询的次数
     * @param string $sn_code
     * @return mixed
     */
    function query(string $sn_code): ?ProductInfo;

    function getBySnCode(string $sn_code);


}