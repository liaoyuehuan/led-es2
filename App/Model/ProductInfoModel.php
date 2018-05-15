<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/20
 * Time: 11:38
 */

namespace App\Model;


use App\Bean\ProductInfo;

class ProductInfoModel extends AbstractBaseModel
{
    protected $expectUpdatePro = [
        'updatetime'
    ];

    public function getSqlBean()
    {
        return ProductInfo::class;
    }
}