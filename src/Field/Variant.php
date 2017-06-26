<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 22.06.2017
 * Time: 12:11
 */

namespace nofuture17\seo_filter\Field;

use nofuture17\seo_filter\Common\ArrayAccessInterface;
use nofuture17\seo_filter\Common\ConfigurableInterface;
use nofuture17\seo_filter\Traits\ArrayAccess;
use nofuture17\seo_filter\Traits\Configure;
use nofuture17\seo_filter\Traits\SetItem;

class Variant implements VariantInterface, ArrayAccessInterface, ConfigurableInterface
{
    use ArrayAccess, Configure, SetItem {
        SetItem::getArrayAccessFields as SetItemGetArrayAccessFields;
        SetItem::getConfigurableFields as SetItemGetConfigurableFields;
    }

    public $name;
    public $url;

    public function __construct($data = [])
    {
        $this->configure($data);
    }

    public function getConfigurableFields()
    {
        return array_merge($this->SetItemGetConfigurableFields(), ['name', 'url']);
    }

    public function getArrayAccessFields()
    {
        return array_merge($this->SetItemGetArrayAccessFields(), ['name', 'url']);
    }
}