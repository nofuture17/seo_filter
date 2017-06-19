<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 09.06.2017
 * Time: 6:50
 */

namespace nofuture17\seo_filter;


class SetInputData extends Set
{
    /**
     * @param null $order
     * @param bool $ignoreFieldsSet
     * @return FieldListItem[]|null
     */
    public function getItems($order = null, $ignoreFieldsSet = false)
    {
        return parent::getItems($order, $ignoreFieldsSet);
    }

    public function isEmpty($ignoreFieldsSet = false)
    {
        return empty($this->getItems(null, $ignoreFieldsSet));
    }
}