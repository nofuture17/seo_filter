<?php

namespace nofuture17\seo_filter_tests;
use nofuture17\seo_filter\Data;

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
     * @depends testFill
     */
    public function testCreate()
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
     * Сгенерировать данные для Data
     * @return array
     */
    protected function generateDataArray($params = [])
    {
        $result = [

        ];

        if (!empty($params['empty'])) {
            return [];
        }

        $result['name'] = (empty($params['noName'])) ? 'Нестовое название фильтра' : '';
        $result['url'] = (empty($params['noUrl'])) ? '/test-filter-url' : '';

        return $result;
    }
}