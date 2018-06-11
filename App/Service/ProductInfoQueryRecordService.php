<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/24
 * Time: 14:26
 */

namespace App\Service;

use App\Model\ProductInfoQueryRecord;
use App\Service\Interfaces\IProductInfoQueryRecordService;
use App\Utils\IpUtils;

class ProductInfoQueryRecordService extends AbstractService implements IProductInfoQueryRecordService
{

    /**
     * @var ProductInfoQueryRecord
     */
    private $productInfoQueryRecordModel;

    public function __construct()
    {
        $this->productInfoQueryRecordModel = ProductInfoQueryRecord::getInstance();
    }

    function record(string $snCode, string $ip): bool
    {
        $bean = new \App\Bean\ProductInfoQueryRecord();
        $bean->setSnCode($snCode);
        $bean->setIp($ip);
        $bean->setCountryCode(IpUtils::getCountryCodeByIp($ip));
        $bean->setQueryTime(time());
        $ipInfo =  ipUtils::getIpInfo($ip);
        if ($ipInfo && $ipInfo['code'] == 0){
            $ipDate = $ipInfo['data'];
            $bean->setCountry($ipDate['country']);
            $bean->setProvince($ipDate['region']);
            $bean->setCity($ipDate['city']);
        }
        return $this->productInfoQueryRecordModel->insert($bean);
    }


}