<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/20
 * Time: 15:03
 */

namespace App\HttpController;


use App\Http\Result;
use EasySwoole\Core\Http\Response;

trait Output
{
    protected function writeToJsonWithNoCode(Response $response, $statusCode = 200, Result $result = null): bool
    {
        if (!$response->isEndResponse()) {
            $response->write(json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $response->withHeader('Content-type', 'application/json;charset=utf-8');
            $response->withStatus($statusCode);
            return true;
        } else {
            trigger_error("response has end");
            return false;
        }
    }
}