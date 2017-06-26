<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 20.06.2017
 * Time: 13:53
 */

namespace nofuture17\seo_filter\Filter;


class Value implements ValueInterface
{
    public static $fieldsDelimiter = '/';
    public static $valueDelimiter = '_';
    public $fields = [];

    public function __construct($data = null)
    {
        if (!empty($data)) {
            $this->set($data);
        }
    }

    /**
     * @inheritdoc
     */
    public function set($data)
    {
        $this->fields = [];
        $this->add($data);
    }

    /**
     * @inheritdoc
     */
    public function add($data)
    {
        if (is_array($data)) {
            $this->addFormArray($data);
        } elseif (is_string($data)) {
            $this->addFromString($data);
        }
    }

    /**
     * @inheritdoc
     */
    public function get()
    {
        return $this->fields;
    }

    /**
     * @inheritdoc
     */
    public function isEquals(ValueInterface $otherValue)
    {
        $result = true;
        $selfItems = $this->get();
        $otherItems = $otherValue->get();
        $cnt = count($selfItems);
        if ($cnt != count($otherValue->get())) {
            return false;
        }
        for ($i = 0; $i < $cnt; $i++) {
            $selfKey = key($selfItems);
            $otherKey = key($otherItems);
            if ($selfKey != $otherKey) {
                $result = false;
                break;
            }

            if ($selfItems[$selfKey] !== $otherItems[$selfKey]) {
                $result = false;
                break;
            }

            next($selfItems);
            next($otherItems);
        }

        return $result;
    }

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

    public function isEmpty()
    {
        return empty($this->fields);
    }
}