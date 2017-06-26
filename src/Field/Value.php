<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 22.06.2017
 * Time: 23:16
 */

namespace nofuture17\seo_filter\Field;


class Value implements ValueInterface
{
    /**
     * Имеет только одно значение
     * @var bool
     */
    public $isOnce;
    public $data;

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        $result = [];

        if (!is_array($this->data)) {
            $result[] = $this->data;
        } else {
            $result = array_values($this->data);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function isIn($valuePart)
    {
        if ($this->isOnce) {
            return $this->isEquals($valuePart);
        }

        return in_array($valuePart, $this->data);
    }

    /**
     * @inheritdoc
     */
    public function isEquals($value)
    {
        return $value == $this->data;
    }

    /**
     * @inheritdoc
     */
    public function set($data)
    {
        if (is_array($data) && $this->isOnce) {
            $this->data = array_shift($data);
        } else {
            $this->data = $data;
        }

        return $this;
    }

    public function setIsOnce($once = false)
    {
        $this->isOnce = (bool)$once;
        return $this;
    }
}