<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 02.06.2017
 * Time: 10:21
 */

namespace nofuture17\seo_filter;


class Field extends Item
{
    const ACTIVE_ACTIVE = 1;
    const ACTIVE_DISABLE = 2;

    const EXCEPTION_CODE_INVALID_NAME = 1;
    const EXCEPTION_CODE_INVALID_URL = 2;
    const EXCEPTION_CODE_INVALID_TYPE = 3;
    const EXCEPTION_CODE_INVALID_VALUE = 4;
    const EXCEPTION_CODE_INVALID_DATA = 5;

    public $name;
    public $priority;
    public $url;
    public $type;
    public $inputData;
    public $active;
    public $value;

    public function __construct($data)
    {
        if (empty($data)) {
            throw new \Exception('Нет данных', self::EXCEPTION_CODE_INVALID_DATA);
        }

        if (empty($data['name'])) {
            throw new \Exception('Не указано имя поля', self::EXCEPTION_CODE_INVALID_NAME);
        }

        if (empty($data['url'])) {
            throw new \Exception('Не указан url поля', self::EXCEPTION_CODE_INVALID_URL);
        }

        if (empty($data['type'])) {
            throw new \Exception('Не указан тип поля', self::EXCEPTION_CODE_INVALID_TYPE);
        }

        $this->configure($data);

        if (!isset($this->active)) {
            $this->active = self::ACTIVE_ACTIVE;
        }
    }

    public function getValue()
    {

    }

    public function setValue($value)
    {

    }
}