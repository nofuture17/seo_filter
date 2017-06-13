<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 09.06.2017
 * Time: 12:35
 */

namespace nofuture17\seo_filter\Traits;


trait ArrayAccess
{
    public function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->$offset;
        }

        return null;
    }

    public function offsetSet($offset, $value)
    {
        if ($this->offsetExists($offset)) {
            $this->$offset = $value;
        }
    }

    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            $this->$offset = null;
        }
    }
}