<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 01.06.2017
 * Time: 22:05
 */

require_once __DIR__ . '/../vendor/autoload.php';

use nofuture17\seo_filter\Data;
use nofuture17\seo_filter\Factory;
use nofuture17\seo_filter\HtmlGenerator;
use nofuture17\seo_filter\ValueFilter;
use nofuture17\seo_filter_tests\DataTest;

$filePath = '../tests/runtime/html.html';


function getValue()
{
    $valueData = [
        'test-field' => ['test-value', 'test-value3'],
        'test-field2' => ['test-value2', 'test-value3'],
        'test-field3' => 4
    ];
    $value = new ValueFilter($valueData);
    return $value;
}

$fieldsData = (new DataTest())->getFieldsData();
$data = (new DataTest())->generateDataArray(['fieldsData' => $fieldsData]);
$data = new Data($data);
$filter = Factory::create($data);
$filter->setValue(getValue());

file_put_contents(__DIR__ . '/' . $filePath, (new HtmlGenerator($filter))->getHtml());
die;
