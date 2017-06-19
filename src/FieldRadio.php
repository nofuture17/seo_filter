<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 08.06.2017
 * Time: 15:59
 */

namespace nofuture17\seo_filter;


use nofuture17\seo_filter\Traits\ListField;

class FieldRadio extends Field
{
    use ListField;

    public $valueClass = '\nofuture17\seo_filter\ValueScalar';

    public function validateValue($value)
    {
        $trueValue = null;

        $value = call_user_func([$this->valueClass, 'clearValue'], $value);

        if ($this->inputData->hasItem($value)) {
            $trueValue = $value;
        }

        return $trueValue;
    }
}