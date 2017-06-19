<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 15.06.17
 * Time: 13:11
 */

namespace nofuture17\seo_filter_tests;

use nofuture17\seo_filter\Data;
use nofuture17\seo_filter\Factory;
use nofuture17\seo_filter\HtmlGenerator;
use nofuture17\seo_filter\ValueFilter;

class HtmlTest extends \PHPUnit_Framework_TestCase
{
    public $filePath = 'runtime/html.html';

    /**
     * @test
     */
    public function testHtml()
    {
        $fieldsData = (new DataTest())->getFieldsData();
        $data = (new DataTest())->generateDataArray(['fieldsData' => $fieldsData]);
        $data = new Data($data);
        $filter = Factory::create($data);
        $filter->setValue($this->getValue());

        file_put_contents(__DIR__ . '/' . $this->filePath, (new HtmlGenerator())->getHtml($filter));
        die;
    }

    public function getValue()
    {
        $valueData = [
            'test-field' => ['test-value', 'test-value3'],
            'test-field2' => ['test-value2', 'test-value3'],
            'test-field3' => 4
        ];
        $value = new ValueFilter($valueData);
        return $value;
    }
}