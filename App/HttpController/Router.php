<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 16:18
 */

namespace App\HttpController;


use FastRoute\RouteCollector;

class Router extends \EasySwoole\Core\Http\AbstractInterface\Router
{

    function register(RouteCollector $routeCollector)
    {
        $routeCollector->addRoute(['GET','POST'],'/router/rest','/api/router/rest');
        $routeCollector->post('/route','/api/router/rest');
    }
}