<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-5-14
 * Time: 15:05
 */

namespace App\Filter\Action;


use App\Consts\ErrorCodeConst;
use App\HttpController\Output;
use App\Methods\MethosUtil;
use EasySwoole\Core\AbstractInterface\Singleton;
use EasySwoole\Core\Http\Message\Status;
use EasySwoole\Core\Http\Request;
use EasySwoole\Core\Http\Response;

class MethodCheckFilter implements IActionFilter
{
    use Output, Singleton;

    function requestHandler(Request $request, Response $response): bool
    {
        $method = $request->getRequestParam('method');
        if (false === MethosUtil::getInstance()->mapExists($method)) {
            $this->writeToJsonWithNoCode($response, Status::CODE_OK,
                \App\Http\Result::makeError(ErrorCodeConst::INVALID_ARGUMENT, 'method not found'));
            return false;
        }
        return true;
    }

}