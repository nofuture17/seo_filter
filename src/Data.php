<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 01.06.2017
 * Time: 22:17
 */

namespace nofuture17\seo_filter;


use nofuture17\seo_filter\Traits\ArrayAccess;

class Data implements \ArrayAccess
{
    use ArrayAccess;

    const EXCEPTION_CODE_INVALID_NAME = 1;
    const EXCEPTION_CODE_INVALID_URL = 2;
    const EXCEPTION_CODE_INVALID_DATA = 3;
    const EXCEPTION_CODE_INVALID_FIELD_DATA = 4;

    public $name;
    public $url;
    public $text;
    public $fields = [];
    public $fieldsSet;

    public function __construct($data)
    {
        if (is_array($data)) {
            $this->setFromArray($data);
        } elseif (is_string($data)) {
            $this->setFromJson($data);
        } else {
            throw new \Exception('Некорректные данные', self::EXCEPTION_CODE_INVALID_DATA);
        }
    }

    public function setFromArray($data)
    {
        if (empty($data)) {
            throw new \Exception('Пустые данные', self::EXCEPTION_CODE_INVALID_DATA);
        }

        if (!empty($data['name'])) {
            $this->name = $data['name'];
        } else {
            throw new \Exception('Небходимо задать имя фильтра', self::EXCEPTION_CODE_INVALID_NAME);
        }

        if (!empty($data['url'])) {
            $this->url = $data['url'];
        } else {
            throw new \Exception('Небходимо задать url фильтра', self::EXCEPTION_CODE_INVALID_URL);
        }

        $this->addFieldsData($data);
    }

    public function setFromJson($data)
    {
        $this->setFromArray(json_decode($data, true));
    }

    public function addFieldsData($data)
    {
        if (empty($data['fieldsData'])) {
            return null;
        }

        foreach ($data['fieldsData'] as $fieldData) {
            $this->addFieldData($fieldData);
        }
    }

    public function addFieldData($data)
    {
        if (empty($data['name'])) {
            throw new \Exception('Необходимо указать имя поля', self::EXCEPTION_CODE_INVALID_FIELD_DATA);
        }

        if (empty($data['url'])) {
            throw new \Exception('Необходимо указать url поля', self::EXCEPTION_CODE_INVALID_FIELD_DATA);
        }

        if (empty($data['type'])) {
            throw new \Exception('Необходимо указать тип поля', self::EXCEPTION_CODE_INVALID_FIELD_DATA);
        }

        $this->fields[$data['url']] = $data;
    }
}