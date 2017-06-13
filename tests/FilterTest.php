<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 09.06.2017
 * Time: 10:06
 */

namespace nofuture17\seo_filter_tests;


use nofuture17\seo_filter\Data;
use nofuture17\seo_filter\Factory;

class FilterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * - ошибки создания фильтра
     * - нормальное создание фильтра
     * @test
     */
    public function testCreate()
    {
        $fieldsData = (new DataTest())->getFieldsData();
        $data = (new DataTest())->generateDataArray(['fieldsData' => $fieldsData]);
        $data = new Data($data);
        $filter = Factory::create($data);
        var_dump($filter);
    }
}