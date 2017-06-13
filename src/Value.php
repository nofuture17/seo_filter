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
        return true;
    }

    public function getValue()
    {
        return null;
    }

    public function set($data)
    {
        $this->valueData = $data;
    }
}