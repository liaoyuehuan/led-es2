<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-5-14
 * Time: 13:59
 */

namespace App\Service;


use App\Model\LiveMessageModel;
use App\Service\Interfaces\ILiveMessageService;
use App\Utils\IpUtils;

/**
 * Class LiveMessageService
 * @package App\Service
 */
class LiveMessageService extends AbstractService implements ILiveMessageService
{
    /**
     * @var LiveMessageModel
     */
    private $liveMessageModel;


    public function __construct()
    {
        $this->liveMessageModel = LiveMessageModel::getInstance();
    }


    /**
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    function liveMessage($data = [])
    {
        $bean = $this->liveMessageModel->createSplBeanFromData($data);
        if ($bean->getIp()) {
            $bean->setCountryCode(IpUtils::getCountryCodeByIp($bean->getIp()));
        }
        return $this->liveMessageModel->insert($bean);
    }

}