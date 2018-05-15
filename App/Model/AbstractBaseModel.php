<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/15/015
 * Time: 10:07
 */

namespace App\Model;

use App\Http\Pagination;
use App\Utility\MysqlPool;
use EasySwoole\Config;
use EasySwoole\Core\Component\Spl\SplBean;
use EasySwoole\Core\Swoole\Coroutine\PoolManager;

abstract class AbstractBaseModel implements IBaseModel
{

    protected $pk = 'id';

    protected $expectUpdatePro = [];

    /**
     * @var SplBean
     */
    private $splBean;

    /**
     * @var array
     */
    protected $columns;

    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var object[]
     */
    protected static $instance;

    /**
     * @var PoolManager
     */
    protected $poolManager;

    /**
     * @var MysqlPool
     */
    protected $mysqlPool;

    protected $prefix;


    public function __construct()
    {
        $this->prefix = Config::getInstance()->getConf('MYSQL.PREFIX');
        $this->splBean = $this->getSqlBean();
        $this->columns = $this->getColumns();
        $this->tableName = $this->prefix . $this->getTableName();
        $this->poolManager = PoolManager::getInstance();
        $this->mysqlPool = $this->poolManager->getPool(MysqlPool::class);
    }

    /**
     * return static
     */
    public static function getInstance()
    {
        if (!isset(static::$instance[static::class])) {
            static::$instance[static::class] = new static;
        }
        return static::$instance[static::class];
    }


    /**
     * @param $id
     * @return $this->SplBeanClassName()
     */
    function get($id)
    {
        try {
            $db = $this->mysqlPool->getObj();
            $data = $db->where($this->pk, $id)->getOne($this->tableName, $this->columns);
            return empty($data) ? null : $this->toBean($data);
        } finally {
            if (isset($db)) {
                $this->mysqlPool->freeObj($db);
            }
        }
    }

    /**
     * @param SplBean $bean
     * @return bool
     */
    function insert($bean)
    {
        try {
            $db = $this->mysqlPool->getObj();
            return $db->insert($this->tableName, $bean->toArray($this->columns,SplBean::FILTER_NOT_NULL));
        } finally {
            if (isset($db)) {
                $this->mysqlPool->freeObj($db);
            }
        }
    }

    function insertMulti(array $data)
    {
        try {
            $db = $this->mysqlPool->getObj();
            $mulInsertData = [];
            foreach ($data as &$value) {
                $mulInsertData[] = $value->toArray(SplBean::FILTER_NOT_NULL);
            }
            return $db->insertMulti($this->tableName, $mulInsertData);
        } finally {
            if (isset($db)) {
                $this->mysqlPool->freeObj($db);
            }
        }

    }


    /**
     * $@param $bean SplBean
     * @return bool
     */
    function merge($bean)
    {
        $get = 'get' . $this->propertyToHump($this->pk);
        $id = $bean->$get();
        if (empty($this->get($id))) {
            return $this->insert($bean);
        } else {
            return $this->update($id, $bean);
        }
    }


    /**
     * @param $id string
     * @param $bean SplBean
     * @return bool
     */
    function update($id, $bean)
    {
        try {
            $db = $this->mysqlPool->getObj();
            $set = 'set' . $this->propertyToHump($this->pk);
            $bean->$set(null);
            $this->handleExpectUpdatePro($bean);
            return $db->where($this->pk, $id)->update($this->tableName, $bean->toArray($this->columns,SplBean::FILTER_NOT_NULL));
        } finally {
            if (isset($db)) {
                $this->mysqlPool->freeObj($db);
            }
        }

    }

    function getOne(callable $callable)
    {
        try {
            $db = $this->mysqlPool->getObj();
            $callable !== null && $callable($db);
            $beanArray = $db->getOne($this->tableName, $this->columns);
            return empty($beanArray) ? null : $this->toBean($beanArray);
        } finally {
            if (isset($db)) {
                $this->mysqlPool->freeObj($db);
            }
        }

    }


    /**
     * @param int|array $numRows Array to define SQL limit in format Array ($offset, $count)
     *                  or only $count
     * @param callable $callable
     * @return array
     */
    function select($numRows = null, callable $callable = null)
    {
        try {
            $db = $this->mysqlPool->getObj();
            $callable !== null && $callable($db);
            return $this->toBeanArray($db->get($this->tableName, $numRows, $this->columns));
        } finally {
            if (isset($db)) {
                $this->mysqlPool->freeObj($db);
            }
        }

    }

    /**
     * @param $page
     * @param $limit
     * @param callable|null $callable
     * @return Pagination
     */
    function pagination($page, $limit, callable $callable = null)
    {
        try {
            $db = $this->mysqlPool->getObj();
            $callable !== null && $callable($db);
            $db->pageLimit = $limit;
            $data = $db->paginate($this->tableName, $page, $this->columns);;
            return new Pagination($db->totalCount, $this->toBeanArray($data));
        } finally {
            if (isset($db)) {
                $this->mysqlPool->freeObj($db);
            }
        }

    }

    /**\
     * @param SplBean $bean
     * @param int $numRows Limit on the number of rows that can be updated.
     * @param callable|null $callable
     */
    function updateByWhere($bean = null, $numRows = null, callable $callable = null)
    {
        try {
            $db = $this->mysqlPool->getObj();
            $callable !== null && $callable($db);
            $db->update($this->tableName, $bean->toArray(), $numRows);
        } finally {
            if (isset($db)) {
                $this->mysqlPool->freeObj($db);
            }
        }

    }

    function insertGetInsertId($bean): string
    {
        try {
            $db = $this->mysqlPool->getObj();
            $result = $db->insert($this->tableName, $bean->toArray(SplBean::FILTER_NOT_NULL));
            if ($result) {
                return $db->getInsertId();
            } else {
                return null;
            }
        } finally {
            if (isset($db)) {
                $this->mysqlPool->freeObj($db);
            }
        }
    }


    function createSplBeanFromData(array $data)
    {
        $filter_data = array_filter($data, function ($value) {
            if (in_array($value, $this->columns)) {
                return true;
            } else {
                return false;
            }
        }, ARRAY_FILTER_USE_KEY);
        return $this->getSplBeanInstance($filter_data);
    }


    protected function getTableName()
    {
        $shortName = (new \ReflectionClass($this->splBean))->getShortName();
        return $this->getTableNameFromShortName($shortName);
    }

    private function getTableNameFromShortName($shortName)
    {
        return strtolower(preg_replace('/(?<=[a-z])(?=[A-Z])/', '_', $shortName));
    }

    protected function getColumns()
    {
        return $this->getSplBeanInstance()->getVarList();
    }

    /**
     * @param array $args
     * @return SplBean
     */
    protected function getSplBeanInstance($args = [])
    {
        return (new \ReflectionClass($this->splBean))->newInstance($args);
    }

    protected function toBeanArray(array $dataArr)
    {
        return array_map(function ($value) {
            return $this->toBean($value);
        }, $dataArr
        );
    }

    protected function toBean(array $data)
    {
        return $this->getSplBeanInstance($data);
    }

    public function propertyToHump($property)
    {
        return str_replace('_', '', ucwords(ucfirst($property), '_'));
    }

    /**
     * @return string SplBeanClassName
     */
    abstract public function getSqlBean();

    protected function handleExpectUpdatePro(&$bean)
    {
        foreach ($this->expectUpdatePro as &$value) {
            $set = 'set' . $this->propertyToHump($value);
            $bean->$set(null);
        }
    }

}