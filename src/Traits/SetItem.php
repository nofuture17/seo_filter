<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 22.06.2017
 * Time: 23:51
 */

namespace nofuture17\seo_filter\Traits;


trait SetItem
{
    /**
     * @inheritdoc
     */
    public static function getActiveArray()
    {
        return [
            'active' => 1,
            'disabled' => 2,
            'hidden' => 3
        ];
    }

    public function getArrayAccessFields()
    {
        return ['active', 'priority'];
    }

    public function getConfigurableFields()
    {
        return ['active', 'priority'];
    }

    public $active = 1;
    public $priority = 100;

    public function getActive()
    {
        return $this->active;
    }

    public function getPriority()
    {
        return $this->priority;
    }
}