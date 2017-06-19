<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 08.06.2017
 * Time: 15:52
 */

namespace nofuture17\seo_filter;


use nofuture17\seo_filter\Traits\ListField;

class FieldCheckbox extends Field
{
    use ListField;

    /**
     * @param $value
     * @return array|null
     */
    public function validateValue($value)
    {
        $trueValue = [];
        foreach ($value as $item) {
            if ($this->inputData->hasItem($item)) {
                $trueValue[] = $item;
            }
        }

        return !empty($trueValue) ? $trueValue : null;
    }
}