<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 20.06.2017
 * Time: 13:49
 */

namespace nofuture17\seo_filter\Filter;


interface ValueInterface
{
    public function __construct($data = null);

    /**
     * Разобрать переданные данные
     * @param $data
     * @return mixed
     */
    public function set($data);

    /**
     * Дополнить значение преданными данными
     * @param $data
     * @return mixed
     */
    public function add($data);

    /**
     * Массив со значениями полей
     * @return array
     */
    public function get();

    /**
     * Сравнить объекты значения
     * @param ValueInterface $otherValue
     * @return bool
     */
    public function isEquals(ValueInterface $otherValue);

    public function isEmpty();
}