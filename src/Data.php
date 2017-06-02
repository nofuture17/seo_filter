<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 01.06.2017
 * Time: 22:17
 */

namespace nofuture17\seo_filter;


class Data
{
    const EXCEPTION_CODE_INVALID_NAME = 1;
    const EXCEPTION_CODE_INVALID_URL = 2;
    const EXCEPTION_CODE_INVALID_DATA = 3;

    public $name;
    public $url;
    public $fields = [];
    public $value;

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
            $this->name = $data['url'];
        } else {
            throw new \Exception('Небходимо задать url фильтра', self::EXCEPTION_CODE_INVALID_URL);
        }
    }

    public function setFromJson($data)
    {
        $this->setFromArray(json_decode($data, true));
    }
}