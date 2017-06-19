<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 09.06.2017
 * Time: 6:36
 */

namespace nofuture17\seo_filter;


class Value
{
    public $valueData;

    public function isEmpty()
    {
        return !isset($this->valueData);
    }

    public function getValue()
    {
        return $this->valueData;
    }

    public function set($data)
    {
        $this->valueData = $data;
    }
}