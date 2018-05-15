<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/20
 * Time: 11:02
 */

namespace App\Bean;

class ProductInfo extends BaseBean
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $sn_code;

    /**
     * @var int
     */
    protected $month_query_times;

    /**
     * @var string
     */
    protected $is_certified;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var int
     */
    protected $input_time;


    /**
     * @var string
     */
    protected $status;


    public function initialize(): void
    {
        parent::initialize();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSnCode(): ?string
    {
        return $this->sn_code;
    }

    /**
     * @param mixed $sn_code
     */
    public function setSnCode(?string $sn_code): void
    {
        $this->sn_code = $sn_code;
    }

    /**
     * @return int
     */
    public function getMonthQueryTimes(): ?int
    {
        return $this->month_query_times;
    }

    /**
     * @param int $month_query_times
     */
    public function setMonthQueryTimes(?int $month_query_times): void
    {
        $this->month_query_times = $month_query_times;
    }

    /**
     * @return string
     */
    public function getisCertified(): ?string
    {
        return $this->is_certified;
    }

    /**
     * @param string $is_certified
     */
    public function setIsCertified(?string $is_certified): void
    {
        $this->is_certified = $is_certified;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(?string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getInputTime(): ?int
    {
        return $this->input_time;
    }

    /**
     * @param int $input_time
     */
    public function setInputTime(?int $input_time): void
    {
        $this->input_time = $input_time;
    }



    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }


}