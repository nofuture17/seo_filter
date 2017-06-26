<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 22.06.2017
 * Time: 10:59
 */

namespace nofuture17\seo_filter\Field;


interface VariantInterface
{
    /**
     * Массив статусов активности
     * @return array
     */
    public static function getActiveArray();
}