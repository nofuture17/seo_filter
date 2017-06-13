<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 09.06.2017
 * Time: 6:24
 */

namespace nofuture17\seo_filter;


use nofuture17\seo_filter\Traits\ArrayAccess;
use nofuture17\seo_filter\Traits\Configure;

class Item implements \ArrayAccess
{
    use Configure;
    use ArrayAccess;
}