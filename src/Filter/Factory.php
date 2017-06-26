<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 22.06.2017
 * Time: 7:47
 */

namespace nofuture17\seo_filter\Filter;


class Factory
{
    /**
     * @param DataInterface $data
     * @param array $config
     * @param ValueInterface|null $value
     * @param array $fields
     * @return Filter
     */
    public static function create(
        DataInterface $data,
        $config = [],
        ValueInterface $value = null,
        $fields = null
    )
    {
        //3. Создать объект фильтра
        $filter = new Filter();
        //3.1 Передать ему массив конфигурации
        if (!empty($config)) {
            $filter->setConfig($config);
        }
        //3.2 Передать ему объект с подготовленными данными
        $filter->setData($data);
        if (!empty($fields)) {
            $filter->setFields($fields);
        }
        //3.3 Передать фильтру объект значения
        if (!empty($value)) {
            $filter->setValue($value);
        }

        return $filter;
    }
}