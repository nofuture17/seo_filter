<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 09.06.2017
 * Time: 6:38
 */

namespace nofuture17\seo_filter;


class ValueScalar extends Value
{
    public static function clearValue($dirtyValue)
    {
        $result = null;

        if (empty($dirtyValue) && !is_bool($dirtyValue)) {
            return $result;
        }

        if (is_array($dirtyValue)) {
            $result = array_shift($dirtyValue);
        }

        return $result;
    }
}