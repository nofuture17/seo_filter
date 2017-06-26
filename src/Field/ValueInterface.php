<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 22.06.2017
 * Time: 13:27
 */

namespace nofuture17\seo_filter\Field;


interface ValueInterface
{
    /**
     * Представить значение в виде массива
     * @return array
     */
    public function toArray();

    /**
     * Проверка наличия части значения
     *  - для значений с одним вариантом эквиватентно self::isEquals()
     * @param $valuePart
     * @return bool
     */
    public function isIn($valuePart);

    /**
     * Проверка совпадения значения
     *  - Для массивов учитывает порядок элементов
     * @param $value
     * @return bool
     */
    public function isEquals($value);

    /**
     * Установить значение
     * @param $data
     * @return self
     */
    public function set($data);
}