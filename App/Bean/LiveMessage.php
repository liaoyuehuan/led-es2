<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-5-14
 * Time: 13:47
 */

namespace App\Bean;


class LiveMessage extends BaseBean
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $linkman;

    /**
     * @var string 可以邮箱或者联系电话
     */
    protected $contact;

    /**
     * @var string
     */
    protected $info;

    /**
     * @var string
     */
    protected $ip;

    /**
     * @var string
     */
    protected $country_code;

    /**
     * @var int
     */
    protected $is_reply;

    /**
     * @var int
     */
    protected $reply_time;

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
    public function getLinkman(): ?string
    {
        return $this->linkman;
    }

    /**
     * @param string $linkman
     */
    public function setLinkman(?string $linkman): void
    {
        $this->linkman = $linkman;
    }

    /**
     * @return string
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }

    /**
     * @param string $contact
     */
    public function setContact(?string $contact): void
    {
        $this->contact = $contact;
    }

    /**
     * @return string
     */
    public function getInfo(): ?string
    {
        return $this->info;
    }

    /**
     * @param string $info
     */
    public function setInfo(?string $info): void
    {
        $this->info = $info;
    }

    /**
     * @return string
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp(?string $ip): void
    {
        $this->ip = $ip;
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
     * @return int
     */
    public function getisReply(): ?int
    {
        return $this->is_reply;
    }

    /**
     * @param int $is_reply
     */
    public function setIsReply(?int $is_reply): void
    {
        $this->is_reply = $is_reply;
    }

    /**
     * @return int
     */
    public function getReplyTime(): ?int
    {
        return $this->reply_time;
    }

    /**
     * @param int $reply_time
     */
    public function setReplyTime(?int $reply_time): void
    {
        $this->reply_time = $reply_time;
    }

}