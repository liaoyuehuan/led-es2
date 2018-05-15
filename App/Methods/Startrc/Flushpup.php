<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-5-14
 * Time: 11:11
 */

namespace App\Methods\Startrc;


use App\Service\Interfaces\ILiveMessageService;
use App\Service\LiveMessageService;
use App\Service\ProductInfoQueryRecordService;
use App\Service\ProductInfoService;
use EasySwoole\Core\Utility\Validate\Validate;
use EasySwoole\Core\Utility\Validate\Rules;


class Flushpup
{
    /**
     * @var ProductInfoService
     */
    private $productInfoService;

    /**
     * @var ProductInfoQueryRecordService
     */
    private $productInfoQueryRecordService;


    /**
     * @var ILiveMessageService
     */
    private $liveMessageService;

    public function __construct()
    {
        $this->productInfoService = ProductInfoService::getInstance();
        $this->productInfoQueryRecordService = ProductInfoQueryRecordService::getInstance();
        $this->liveMessageService = LiveMessageService::getInstance();
    }

    /**
     * 查询闪浆的信息
     * @param $param
     * @return array
     */
    public function querySnRequestTimes($param)
    {
        //validate
        $validate = new Validate();
        $rules = new Rules();
        $rules->add('sn_code', Validate::REQUIRED);
        $result = $validate->validate($param, $rules);
        if ($result->hasError()) {
            throw new \InvalidArgumentException(json_encode($result->getErrorList()->all()));
        }
        //main body
        $sn_code = $param['sn_code'];
        $productInfo = $this->productInfoService->query($sn_code);
        if ($productInfo) {
            $data = [
                'data' => [
                    'sn_code' => $sn_code,
                    'query_times' => $productInfo->getMonthQueryTimes(),
                    'type' => $productInfo->getType()
                ]
            ];
            $ip = $param['ip'];
            ProductInfoQueryRecordService::getInstance()->record($sn_code, $ip);
            return $data;
        } else {
            throw new \RuntimeException('product into not found');
        }
    }

    public function liveMessage($param)
    {
        $validate = new Validate();
        $rules = new Rules();
        $rules->add('info')->withRule(Validate::REQUIRED);
        $rules->add('linkman')->withRule(Validate::REQUIRED);
        $rules->add('contact')->withRule(Validate::REQUIRED);
        $result = $validate->validate($param, $rules);
        if ($result->hasError()) {
            throw new \InvalidArgumentException(json_encode($result->getErrorList()->all()));
        }

        $rules2 = new Rules();
        $rules->add('contact')->withRule(Validate::IP);
        $result2 = $validate->validate($param, $rules2);
        if ($result->hasError()) {
            throw new \InvalidArgumentException(json_encode($result->getErrorList()->all()));
        }

        $rules3 = new Rules();
        $rules->add('contact')->withRule(Validate::REGEX, '/([\w\-]+\@[\w\-]+\.[\w\-]+)/');
        $result3 = $validate->validate($param, $rules3);
        if ($result2->hasError() || $result3->hasError()) {
            throw new \InvalidArgumentException('The contact does not conform to the mail or tel rule');
        }

        $result = $this->liveMessageService->liveMessage($param);
        if ($result) {
            return ['msg' => 'live message success'];
        } else {
            throw new \RuntimeException('system error');
        }

    }
}