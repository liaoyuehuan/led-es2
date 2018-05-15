<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/24
 * Time: 14:23
 */

namespace App\Model;


class ProductInfoQueryRecord extends AbstractBaseModel
{
    protected $expectUpdatePro = [
        'updatetime'
    ];

    public function getSqlBean()
    {
        return \App\Bean\ProductInfoQueryRecord::class;
    }

}