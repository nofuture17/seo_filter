<?php

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../autoload_tests.php';
require_once __DIR__ . '/../vendor/autoload.php';

$printer = new PHPUnit_TextUI_ResultPrinter();
$dataTestResult = (new \nofuture17\seo_filter_tests\DataTest('testCreate'))->run();
$printer->printResult($dataTestResult);