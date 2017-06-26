<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 21.06.2017
 * Time: 11:49
 */

namespace nofuture17\seo_filter\Traits;


use nofuture17\seo_filter\Common\ArrayAccessInterface;

trait Configure
{
    /**
     * Установить параметры объекта из массива
     * @param ArrayAccessInterface|array $config
     * @param bool $setEmpty
     * @return self
     */
    protected function configure($config = null)
    {
        if (empty($config)) {
            return;
        }

        foreach ($config as $name => $value) {
            if (
                isset($value)
                && (property_exists($this, $name) && in_array($name, $this->getConfigurableFields()))
            ) {
                $this->$name = $value;
            }
        }

        return $this;
    }
}