<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-5-14
 * Time: 11:15
 */

namespace App\Methods;


use App\Exception\MethodNotFoundException;
use App\Methods\Startrc\Flushpup;
use EasySwoole\Core\AbstractInterface\Singleton;
use EasySwoole\Core\Component\Invoker;

class MethosUtil
{
    use Singleton;

    /**
     * @var array $maps
     */
    private $maps;

    /**
     * @var array
     */
    private $methodInstances = [];

    public function __construct($maps = [])
    {
        if (empty($maps)) {
            $this->initMaps();
        }
    }

    protected function initMaps()
    {
        $this->maps = [
            'startrc.flushpup.querysnrequesttimes' => [Flushpup::class => 'querySnRequestTimes'],
            'startrc.flushpup.liveMessage' => [Flushpup::class => 'liveMessage'],
        ];
    }

    private function addMethodInstance(string $methodClass, $obj)
    {
        $this->methodInstances[$methodClass] = $obj;
    }

    private function getMethodInstance(string $methodClass)
    {
        return $this->methodInstances[$methodClass] ?? null;
    }

    public function clearMethodInstance()
    {
        $this->methodInstances = [];
    }


    public function getMap($method)
    {
        return $this->maps[$method] ?? null;
    }

    public function mapExists($method)
    {
        return isset($this->maps[$method]);
    }

    public function callMethod(string $method, $param = [])
    {
        $map = $this->getMap($method);
        if (null === $map) {
            throw new MethodNotFoundException('method not found');
        }
        $methodClass = key($map);
        $callMethod = $map[$methodClass];
        $instance = $this->getMethodInstance($methodClass);
        if (null == $instance) {
            $instance = new $methodClass;
            $this->addMethodInstance($methodClass, $instance);
        }
        return Invoker::callUserFunc([$instance, $callMethod], $param);
    }

}