<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 17:10
 */

namespace App\Http;


class Result implements \JsonSerializable
{
    /**
     * @var int
     */
    public $is_success;

    /**
     * @var string
     */
    public $error_code;

    /**
     * @var string
     */
    public $error_msg;


    /**
     * @var []
     */
    private $extend_data;

    public function __construct(int $is_success, array $extend_data = [], string $error_code = null, string $error_msg = null)
    {
        $this->is_success = $is_success;
        $this->extend_data = $extend_data;
        $this->error_code = $error_code;
        $this->error_msg = $error_msg;
    }

    public static function makeSuccess(array $extend_data = []): Result
    {
        return new self(1, $extend_data);
    }

    public static function makeError(string $error_code = null, string $error_msg): Result
    {
        return new self(0, [], $error_code, $error_msg);
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        $result = array_filter($vars, function ($value) {
            if ($value === null) {
                return false;
            } else {
                return true;
            }
        });
        if (!empty($this->extend_data)) {
            foreach ($this->extend_data as $key => $value) {
                $result[$key] = $value;
            }
        }
        unset($result['extend_data']);
        return $result;
    }

}