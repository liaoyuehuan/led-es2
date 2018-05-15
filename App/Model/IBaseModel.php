<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/15/015
 * Time: 9:26
 */
namespace App\Model;

interface IBaseModel
{
    function get($id);

    function insert($data);

    function insertMulti(array $data);

    function update($id,$data);

    function select(callable $callable);

    function getOne(callable $callable);

    function pagination($page,$limit, callable $callable = null);

    function updateByWhere(callable $callable);

    function insertGetInsertId($bean):string;

    function createSplBeanFromData(array $data);

}