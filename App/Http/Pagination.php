<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/17/017
 * Time: 14:47
 */

namespace App\Http;


class Pagination
{
    /**
     * @var int
     */
    public  $total;

    /**
     * @var array
     */
    public $data;

    public function __construct(int $total,array $data)
    {
        $this->total = $total;
        $this->data = $data;
    }

}