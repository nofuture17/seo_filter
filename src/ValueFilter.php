<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 10.06.2017
 * Time: 6:37
 */

namespace nofuture17\seo_filter;


class ValueFilter
{
    public static $fieldsDelimiter = '/';
    public static $valueDelimiter = '_';

    public $fields;

    public function addFromString($value)
    {
        $fields = explode(static::$fieldsDelimiter, $value);
        foreach ($fields as $fieldValueString) {
            $fieldValueData = explode(static::$valueDelimiter, $fieldValueString);
            $fieldName = array_shift($fieldValueData);
            if (empty($fieldValueData)) {
                $fieldValue = null;
            } else {
                $fieldValue = $fieldValueData;
            }
            $this->fields[$fieldName] = $fieldValue;
        }
    }

    public function addFormArray($value)
    {
        if (empty($value)) {
            return null;
        }

        foreach ($value as $fieldName => $fieldValue) {
            $this->fields[$fieldName] = $fieldValue;
        }
    }
}