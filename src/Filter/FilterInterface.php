<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 20.06.2017
 * Time: 13:40
 */

namespace nofuture17\seo_filter\Filter;


use nofuture17\seo_filter\Common\Set;

interface FilterInterface
{
    /**
     * @return string|null
     */
    public function getName();
    /**
     * @return string|null
     */
    public function getH1();
    /**
     * @return string|null
     */
    public function getTitle();
    /**
     * @return string|null
     */
    public function getText();

    /**
     * Получить набор полей
     * @return Set
     */
    public function getFields();

    public function getRules();

    /**
     * Создать объект значения из состояния фильтра
     * @return ValueInterface
     */
    public function getValue();

    /**
     * Массив конфигурации фильтра
     * @return array
     */
    public function getConfig();

    /**
     * Заполнить данными
     *  - Заполнить из данных атрибуты фильтра
     *  - Заполнить из данных поля фильтра
     * @param DataInterface $data
     * @return self
     */
    public function setData(DataInterface $data);

    /**
     * Заполнить параметры из конфига
     * @param array $config
     * @return self
     */
    public function setConfig(array $config);

    /**
     *  - Заполнить поля значениями из переданного объекта
     *  - Обновить статусы для полей и вариантов полей
     * @param ValueInterface $value
     * @return self
     */
    public function setValue(ValueInterface $value);

    /**
     * Обновить статусы для полей и вариантов полей
     * @return mixed
     */
    public function implementRules();
}