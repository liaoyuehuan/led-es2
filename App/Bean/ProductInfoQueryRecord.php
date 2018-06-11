<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/24
 * Time: 14:10
 */

namespace App\Bean;


class ProductInfoQueryRecord extends BaseBean
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
     * @var string
     */
    protected $ip;

    /**
     * @var int
     */
    protected $query_time;

    /**
     * @var string
     */
    protected $country_code;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $province;

    /**
     * @var string
     */
    protected $city;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSnCode(): string
    {
        return $this->sn_code;
    }

    /**
     * @param string $sn_code
     */
    public function setSnCode(string $sn_code): void
    {
        $this->sn_code = $sn_code;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return int
     */
    public function getQueryTime(): ?int
    {
        return $this->query_time;
    }

    /**
     * @param int $query_time
     */
    public function setQueryTime(?int $query_time): void
    {
        $this->query_time = $query_time;
    }

    /**
     * @return string
     */
    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    /**
     * @param string $country_code
     */
    public function setCountryCode(?string $country_code): void
    {
        $this->country_code = $country_code;
    }

    /**
     * @return string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }

    /**
     * @param string $province
     */
    public function setProvince(?string $province): void
    {
        $this->province = $province;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }



}