<?php

namespace nofuture17\seo_filter\Traits;
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 09.06.2017
 * Time: 12:17
 */
trait Configure
{
    protected function configure($config = [])
    {
        if (empty($config)) {
            return;
        }

        foreach ($config as $name => $value) {
            if (!empty($value) && property_exists($this, $name)) {
                $this->$name = $value;
            }
        }
    }
}