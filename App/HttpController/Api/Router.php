<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 16:54
 */

namespace App\HttpController\Api;

use App\Consts\ErrorCodeConst;
use App\Filter\Action\MethodCheckFilter;
use App\Filter\Action\TokenCheckFilter;
use App\Http\Result;
use App\HttpController\BaseController;
use App\Methods\MethosUtil;
use App\Utils\IpUtils;
use EasySwoole\Core\Http\Message\Status;

class Router extends BaseController
{
    protected $filterList = [
        TokenCheckFilter::class,
        MethodCheckFilter::class
    ];

    function index()
    {
        $this->response()->write('hello router');
    }

    function rest()
    {
        $param = $this->request()->getRequestParam();
        try {
            $ip = IpUtils::getIp($this->request());
            $param['ip'] = $ip;
            $data = MethosUtil::getInstance()->callMethod($param['method'],$param);
            $this->writeJsonWithNoCode(Status::CODE_OK, Result::makeSuccess($data));
        } catch (\InvalidArgumentException $e) {
            $this->writeJsonWithNoCode(Status::CODE_OK, Result::makeError(ErrorCodeConst::INVALID_ARGUMENT, $e->getMessage()));
        } catch (\RuntimeException $e) {
            $this->writeJsonWithNoCode(Status::CODE_OK, Result::makeError(10003, $e->getMessage()));
        }
    }
}