<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-5-16
 * Time: 17:55
 */

namespace App\HttpController\Api;

use App\Http\Result;
use App\HttpController\BaseController;
use App\Service\ConfigService;
use EasySwoole\Core\Http\Message\Status;

class Publics extends BaseController
{
    function index()
    {

    }

    function operationStatement(){
        $data = ConfigService::getInstance()->getOperationStatement();
        $this->writeJsonWithNoCode(Status::CODE_OK, Result::makeSuccess(['statement' => $data]));
    }

    function operationStatementHtml(){
        $this->response()->withAddedHeader('Content-Type','text/html;charset=utf-8');
        $data = ConfigService::getInstance()->getOperationStatementHtml();
        $this->response()->write($data);
    }


}