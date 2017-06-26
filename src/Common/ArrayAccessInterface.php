<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 23.06.2017
 * Time: 9:04
 */

namespace nofuture17\seo_filter\Common;


interface ArrayAccessInterface extends \ArrayAccess
{
    public function getArrayAccessFields();
}