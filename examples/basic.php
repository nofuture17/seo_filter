<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 01.06.2017
 * Time: 22:05
 */

require_once __DIR__ . '/../vendor/autoload.php';

use \nofuture17\seo_filter\Filter\Data;
use \nofuture17\seo_filter\Filter\Value;
use \nofuture17\seo_filter\Filter\Factory;
use \nofuture17\seo_filter\Field;

$filePath = '../tests/runtime/html.html';

//1. Создать объект данных фильтра
$dataObject = new Data();
//1.1 Передать ему сырые данные для фильтра
$data = [
    'url' => 'test-filter',
    'baseUrl' => '/f/',
    'name' => 'Тестовый фильтр',
    'h1' => 'Тестовый фильтр h1',
    'title' => 'Тестовый фильтр title',
    'text' => 'Тестовый фильтр text',
    'fields' => [
        'field-checkbox' => [
            'name' => 'Тестовый чекбокс',
            'url' => 'field-checkbox',
            'priority' => 100,
            'type' => 'checkbox',
            'data' => [
                'value1' => [
                    'url' => 'value1',
                    'name' => 'Значение 1',
                    'priority' => 100
                ],
                'value2' => [
                    'url' => 'value2',
                    'name' => 'Значение 2',
                    'priority' => 1000
                ],
                'value3' => [
                    'url' => 'value3',
                    'name' => 'Значение 3',
                    'priority' => 1500
                ],
            ]
        ],
        'field-radio' => [
            'name' => 'Тестовый радио',
            'url' => 'field-radio',
            'priority' => 1000,
            'type' => 'radio',
            'data' => [
                'value1' => [
                    'url' => 'value1',
                    'name' => 'Значение 1',
                    'priority' => 1000
                ],
                'value2' => [
                    'url' => 'value2',
                    'name' => 'Значение 2',
                    'priority' => 100
                ],
            ]
        ],
        'field-select' => [
            'name' => 'Тестовый селект',
            'url' => 'field-select',
            'priority' => 100,
            'type' => 'select',
            'data' => [
                'value1' => [
                    'url' => 'value1',
                    'name' => 'Значение 1',
                    'priority' => 1000
                ],
                'value2' => [
                    'url' => 'value2',
                    'name' => 'Значение 2',
                    'priority' => 100
                ],
            ]
        ],
        'field-range' => [
            'name' => 'Тестовый ползунок',
            'url' => 'field-range',
            'priority' => 100,
            'type' => 'range',
            'data' => [
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'unit' => 'кг/ам',
                'isRange' => true
            ]
        ],
    ],
    'rules' => [

    ],
];
$dataObject->set($data);

//2. Создать объект значения фильтра
$valueObject = new Value();
//2.1 Передать объекту значения данные
$value = 'field-radio_value2/field-range_1_10/field-select_value1/field-checkbox_value1_value3';
//$value = 'field-checkbox_value1_value3_value10/field-radio_value2/field-select_value1/field-range_1_10';
$valueObject->set($value);

$fields = Field\Factory::createSet($dataObject->getFieldsData());
$filter = Factory::create($dataObject, [], $valueObject, $fields);

//4. Проверка значения фильтра
$filterValue = $filter->getValue();
var_dump($filterValue->isEquals($valueObject));die;
//4.2 Сравнить объекты значения
if (!$filterValue->isEquals($valueObject)) {
    //4.3 Если значения не равны, редирект
    echo 'redirect';
}
echo 'Всё ок';