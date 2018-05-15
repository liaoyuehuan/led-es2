<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/20
 * Time: 14:53
 */

namespace App\Filter\Action;

use App\Consts\ErrorCodeConst;
use App\HttpController\Output;
use EasySwoole\Config;
use EasySwoole\Core\AbstractInterface\Singleton;
use EasySwoole\Core\Http\Message\Status;
use EasySwoole\Core\Http\Request;
use EasySwoole\Core\Http\Response;
use EasySwoole\Core\Utility\Validate\Rules;
use EasySwoole\Core\Utility\Validate\Validate;

class TokenCheckFilter implements IActionFilter
{
    use Output, Singleton;

    function requestHandler(Request $request, Response $response): bool
    {
        $validate = new Validate();
        $rules = new Rules();
        $rules->add('method')->withRule(Validate::REQUIRED);
        $rules->add('sign_method')->withRule(Validate::REQUIRED);
        $rules->add('sign')->withRule(Validate::REQUIRED);
        $result = $validate->validate($request->getRequestParam(), $rules);
        if ($result->hasError()) {
            $this->writeToJsonWithNoCode($response, Status::CODE_OK,
                \App\Http\Result::makeError(ErrorCodeConst::INVALID_ARGUMENT, json_encode($result->getErrorList()->all())));
            return false;
        }
        if (false === $this->checkSign($request->getRequestParam())) {
            $this->writeToJsonWithNoCode($response, Status::CODE_OK,
                \App\Http\Result::makeError(ErrorCodeConst::INVALID_SIGN, 'invalid sign'));
            return false;
        }
        return true;
    }

    private function checkSign(array $param)
    {
        $method = $param['method'];
        $sign = $param['sign'];
        $token = Config::getInstance()->getConf('EXTEND.TOKEN');
        $systemSign = md5($method . $token);
        return strtoupper($systemSign) === strtoupper($sign);
    }

}