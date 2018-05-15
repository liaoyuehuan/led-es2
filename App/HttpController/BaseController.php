<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 17:08
 */

namespace App\HttpController;

use App\Filter\Action\TokenCheckFilter;
use App\Http\Result;
use EasySwoole\Core\Http\AbstractInterface\Controller;

abstract class BaseController extends Controller
{

    protected $filterList = [];

    use Output ;

    public function onRequest($action): ?bool
    {
        foreach ($this->filterList as $actionFilterClass) {
            $actionFilter = $actionFilterClass::getInstance();
            $canContinue = $actionFilter->requestHandler($this->request(), $this->response(), $param);
            if ($canContinue === false) {
                return false;
            }
        }
        return parent::onRequest($action); // TODO: Change the autogenerated stub
    }

    protected function writeJsonWithNoCode($statusCode = 200, Result $result = null){
        $this->writeToJsonWithNoCode($this->response(),$statusCode,$result);
    }
}