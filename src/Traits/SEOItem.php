<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 22.06.2017
 * Time: 23:46
 */

namespace nofuture17\seo_filter\Traits;


trait SEOItem
{
    public $name;
    public $url;
    public $h1;
    public $title;
    public $text;

    public function getArrayAccessFields()
    {
        return [
            'name',
            'h1',
            'title',
            'url',
        ];
    }

    public function getConfigurableFields()
    {
        return [
            'name',
            'h1',
            'title',
            'url'
        ];
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getH1()
    {
        return $this->h1;
    }

    public function getUrl()
    {
        return $this->url;
    }
}