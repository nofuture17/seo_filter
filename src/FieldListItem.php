<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 13.06.17
 * Time: 14:21
 */

namespace nofuture17\seo_filter;


use nofuture17\seo_filter\Traits\ArrayAccess;
use nofuture17\seo_filter\Traits\Configure;

class FieldListItem implements \ArrayAccess
{
    use Configure;
    use ArrayAccess;

    const ACTIVE_ACTIVE = 1;
    const ACTIVE_DISABLE = 2;

    public $name;
    public $url;
    public $priority = 100;
    public $active;

    public function __construct($data = [])
    {
        $this->active = self::ACTIVE_ACTIVE;
        $this->configure($data);
    }

    public function isValid()
    {
        $result = true;

        if (empty($this->name)) {
            $result = false;
        }

        if (empty($this->url)) {
            $result = false;
        }

        return $result;
    }
}