<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 21.06.2017
 * Time: 10:28
 */

namespace nofuture17\seo_filter\Field;

/**
 * Хранит и предоставляет доступ к информации поля
 *  - параметры поля
 *  - значение
 *  - данные для инпутов
 * Interface FieldInterface
 * @property string $type
 * @property string $url
 * @property string $name
 * @property string $active
 * @property string $priority
 * @package nofuture17\seo_filter\Field
 */
interface FieldInterface
{
    public function __construct(array $fieldData, $value = null);

    /**
     * Массив статусов активности
     * @return array
     */
    public static function getActiveArray();

    /**
     * Установить значение поля
     * @param $data
     * @return self
     */
    public function setValue($data);

    /**
     * Получить значение поля
     * @return ValueInterface
     */
    public function getValue();

    /**
     * Установить данные
     * @param $inputsData array
     * @return self
     */
    public function setInputsData(array $inputsData);

    /**
     * Получить данные для inputs
     */
    public function getInputsData();

    public function getName();

    public function getUrl();

    public function getActive();

    public function getPriority();
}