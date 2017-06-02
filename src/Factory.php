<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 01.06.2017
 * Time: 22:02
 */

namespace nofuture17\seo_filter;


/**
 * Class Factory
 * @package nofuture17\seo_filter
 */
class Factory
{
    /**
     * Конфигурация по умолчанию для создания фильтра
     */
    public static $defaultConfig = [

    ];

    /**
     * @param Data|string|array $data
     * @param array $config
     * @return Filter
     */
    public static function create(Data $data, $config = [])
    {
        if (!($data instanceof Data)) {
            $data = new Data($data);
        }
        $config = array_merge(self::$defaultConfig, $config);
        return new Filter($data, $config);
    }
}