<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 20.06.2017
 * Time: 13:44
 */

namespace nofuture17\seo_filter\Filter;


interface DataInterface
{
    public function __construct(array $data = []);

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
     * @return array
     */
    public function getFieldsData();

    /**
     * @return array
     */
    public function getRules();

    /**
     * Разобрать данные для фильтра
     * @param array $data
     * @return mixed
     */
    public function set(array $data);
}