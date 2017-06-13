<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 08.06.2017
 * Time: 14:10
 */

namespace nofuture17\seo_filter;


class FieldFactory
{
    const EXCEPTION_CODE_INVALID_TYPE = 1;

    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_SELECT = 'select';
    const TYPE_RADIO = 'radio';
    const TYPE_RANGE = 'range';

    public static $typesToClasses = [
        self::TYPE_CHECKBOX => '\nofuture17\seo_filter\FieldCheckbox',
        self::TYPE_SELECT => '\nofuture17\seo_filter\FieldSelect',
        self::TYPE_RADIO => '\nofuture17\seo_filter\FieldRadio',
        self::TYPE_RANGE => '\nofuture17\seo_filter\FieldRange',
    ];

    /**
     * @param $data
     * @return Field
     */
    public static function create($data)
    {
        $class = static::getClassByData($data);
        return new $class($data);
    }

    public static function getClassByData($data)
    {
        $result = null;

        if (empty($data['type'])) {
            throw new \Exception('Не задан тип поля', self::EXCEPTION_CODE_INVALID_TYPE);
        }

        $type = $data['type'];
        if (!empty(static::$typesToClasses[$type])) {
            $result = static::$typesToClasses[$type];
        } else {
            throw new \Exception('Некоректный тип поля!', self::EXCEPTION_CODE_INVALID_TYPE);
        }

        return $result;
    }
}