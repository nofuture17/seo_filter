<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 08.06.2017
 * Time: 10:39
 */

namespace nofuture17\seo_filter;


class SetFields extends Set
{
    /**
     * @param null $order
     * @param bool $ignoreFieldsSet
     * @return Field[]|null
     */
    public function getItems($order = null, $ignoreFieldsSet = false)
    {
        return parent::getItems($order, $ignoreFieldsSet);
    }

    public function setValues($values)
    {
        if (!empty($values)) {
            foreach ($values as $fieldUrl => $value) {
                if ($this->hasItem($fieldUrl, true)) {
                    $this->getItem($fieldUrl, true)->setValue($value);
                }
            }
        }
    }
}