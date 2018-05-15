<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/30
 * Time: 17:33
 */

namespace App\Filter\Action;

use EasySwoole\Core\Http\Request;
use EasySwoole\Core\Http\Response;

interface IActionFilter
{
    function requestHandler(Request $request, Response $response): bool;
}