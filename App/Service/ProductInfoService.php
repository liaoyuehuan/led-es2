<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/20
 * Time: 13:59
 */

namespace App\Service;


use App\Bean\ProductInfo;
use App\Model\ProductInfoModel;
use App\Service\Interfaces\IProductIntoService;
use EasySwoole\Core\Swoole\Coroutine\Client\Mysql;

class ProductInfoService extends AbstractService implements IProductIntoService
{
    /**
     * @var ProductInfoModel
     */
    private $productInfoModel;


    public function __construct()
    {
        $this->productInfoModel = ProductInfoModel::getInstance();
    }

    function query(string $sn_code): ?ProductInfo
    {
        $productInfo = $this->getBySnCode($sn_code);
        if ($productInfo) {
            $times = $productInfo->getMonthQueryTimes();
            $productInfo->setMonthQueryTimes(++$times);
            if ($this->productInfoModel->update($productInfo->getId(), $productInfo)) {
                return $productInfo;
            } else {
                return null;
            };
        }
        throw new \RuntimeException('this is sn_code not found,please recheck');
    }

    /**
     * @param string $sn_code
     * @return ProductInfo
     */
    function getBySnCode(string $sn_code)
    {
        return $this->productInfoModel->getOne(function (Mysql $db) use ($sn_code) {
            $db->where('sn_code', $sn_code);
        });
    }

}