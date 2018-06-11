<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-5-16
 * Time: 17:28
 */

namespace App\Bean;

use EasySwoole\Core\Component\Spl\SplBean;

class Config extends SplBean
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $group;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $tip;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $rule;

    /**
     * @var string
     */
    protected $extend;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getGroup(): ?string
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function setGroup(?string $group): void
    {
        $this->group = $group;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTip(): ?string
    {
        return $this->tip;
    }

    /**
     * @param string $tip
     */
    public function setTip(?string $tip): void
    {
        $this->tip = $tip;
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
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getRule(): ?string
    {
        return $this->rule;
    }

    /**
     * @param string $rule
     */
    public function setRule(?string $rule): void
    {
        $this->rule = $rule;
    }

    /**
     * @return string
     */
    public function getExtend(): ?string
    {
        return $this->extend;
    }

    /**
     * @param string $extend
     */
    public function setExtend(?string $extend): void
    {
        $this->extend = $extend;
    }

}