<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 08.06.2017
 * Time: 15:59
 */

namespace nofuture17\seo_filter;


class FieldRange extends Field
{
    public $valueClass = '\nofuture17\seo_filter\ValueRange';

    public function setInputData($data)
    {
        $this->inputData = new RangeInputData($data);
    }

    public function getValue($unit = true)
    {
        $value = parent::getValue();
        if ($unit && !empty($this->inputData->unit) && !empty($value)) {
            $value .= ' ' . $this->inputData->unit;
        }
        return $value;
    }

    public function validateValue($value)
    {
        $trueValue = null;
        if (!is_numeric($value)) {
            return null;
        }

        if ($value <= $this->inputData->max && $value >= $this->inputData->min) {
            $trueValue = is_float($value) ? (float) $value : (int) $value;
        }

        return $trueValue;
    }
}