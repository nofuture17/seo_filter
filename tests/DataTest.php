<?php

namespace nofuture17\seo_filter_tests;
use nofuture17\seo_filter\Data;
use nofuture17\seo_filter\FieldFactory;
use nofuture17\seo_filter\FieldListItem;

/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 01.06.2017
 * Time: 22:25
 */
class DataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Проверка создания данных
     * @test
     */
    public function testMainFilterData()
    {
        // Проверка ошибки при пустых данных
        $data = $this->generateDataArray(['empty' => true]);
        $function = function () use ($data) {
            new Data($data);
        };
        $exception = Helper::getException($function);
        $code = null;
        if ($exception instanceof \Exception) {
            $code = $exception->getCode();
        }
        $this->assertEquals($code, Data::EXCEPTION_CODE_INVALID_DATA);

        // Проверка ошибки при отсутсвии имени
        $data = $this->generateDataArray(['noName' => true]);
        $function = function () use ($data) {
            new Data($data);
        };
        $exception = Helper::getException($function);
        $code = null;
        if ($exception instanceof \Exception) {
            $code = $exception->getCode();
        }
        $this->assertEquals($code, Data::EXCEPTION_CODE_INVALID_NAME);

        // Проверка ошибки при отсутсвии url
        $data = $this->generateDataArray(['noUrl' => true]);
        $function = function () use ($data) {
            new Data($data);
        };
        $exception = Helper::getException($function);
        $code = null;
        if ($exception instanceof \Exception) {
            $code = $exception->getCode();
        }
        $this->assertEquals($code, Data::EXCEPTION_CODE_INVALID_URL);
    }

    /**
     * - проверить ошибки поля
     * - проверить сортировку
     * @test
     * @depends testMainFilterData
     */
    public function testFieldsData()
    {
        $fieldsData = $this->getFieldsData();

        // Проверка ошибки при отсутсвии url поля
        $data = $fieldsData;
        unset($data[0]['url']);
        $data = $this->generateDataArray(['fieldsData' => $data]);
        $function = function () use ($data) {
            new Data($data);
        };
        $exception = Helper::getException($function);
        $code = null;
        if ($exception instanceof \Exception) {
            $code = $exception->getCode();
        }
        $this->assertEquals($code, Data::EXCEPTION_CODE_INVALID_FIELD_DATA);


        // Проверка ошибки при отсутсвии имени поля
        $data = $fieldsData;
        unset($data[0]['name']);
        $data = $this->generateDataArray(['fieldsData' => $data]);
        $function = function () use ($data) {
            new Data($data);
        };
        $exception = Helper::getException($function);
        $code = null;
        if ($exception instanceof \Exception) {
            $code = $exception->getCode();
        }
        $this->assertEquals($code, Data::EXCEPTION_CODE_INVALID_FIELD_DATA);

        // Проверка ошибки при отсутсвии типа поля
        $data = $fieldsData;
        unset($data[0]['type']);
        $data = $this->generateDataArray(['fieldsData' => $data]);
        $function = function () use ($data) {
            new Data($data);
        };
        $exception = Helper::getException($function);
        $code = null;
        if ($exception instanceof \Exception) {
            $code = $exception->getCode();
        }
        $this->assertEquals($code, Data::EXCEPTION_CODE_INVALID_FIELD_DATA);

        // Проверка отсутствия ошибки при нормальных данных
        $data = $fieldsData;
        $data = $this->generateDataArray(['fieldsData' => $data]);
        $function = function () use ($data) {
            new Data($data);
        };
        $exception = Helper::getException($function);
        $code = null;
        if ($exception instanceof \Exception) {
            $code = $exception->getCode();
        }
        $this->assertEquals($code, null);

        // Проверка всех полей
        $data = $this->generateDataArray(['fieldsData' => $fieldsData]);
        $dataObject = new Data($data);
        $this->assertEquals(count($fieldsData), count($dataObject->fields));


    }

    /**
     * Сгенерировать данные для Data
     * @return array
     */
    public function generateDataArray($params = [])
    {
        $result = [];

        if (!empty($params['empty'])) {
            return [];
        }

        $result['name'] = (empty($params['noName'])) ? 'Нестовое название фильтра' : '';
        $result['url'] = (empty($params['noUrl'])) ? '/test-filter-url' : '';

        if (isset($params['fieldsData'])) {
            $result['fieldsData'] = $params['fieldsData'];
        }

        if (isset($params['fieldsData'])) {
            $result['fieldsData'] = $params['fieldsData'];
        }

        return $result;
    }

    public function getFieldsData($params = [])
    {
        $result = [
            [
                'name' => 'Тестовое название поля',
                'url' => 'test-field',
                'type' => FieldFactory::TYPE_CHECKBOX,
                'priority' => 1000,
                'inputData' => [
                    [
                        'name' => 'Тестовый вариант',
                        'url' => 'test-value',
                        'priority' => 1000,
                    ],
                    [
                        'name' => 'Тестовый вариант2',
                        'url' => 'test-value2',
                    ],
                    [
                        'name' => 'Тестовый вариант3',
                        'url' => 'test-value3',
                        'active' => FieldListItem::ACTIVE_DISABLE
                    ],
                ]
            ],
            [
                'name' => 'Тестовое название поля 2',
                'url' => 'test-field2',
                'type' => FieldFactory::TYPE_RADIO,
                'priority' => 100,
                'inputData' => []
            ],
            [
                'name' => 'Тестовое название поля 3',
                'url' => 'test-field3',
                'type' => FieldFactory::TYPE_RANGE,
                'priority' => 400,
                'inputData' => [
                    'min' => 1,
                    'max' => 1000,
                    'step' => 10,
                    'unit' => 'кг/ам'
                ]
            ],
        ];

        return $result;
    }
}