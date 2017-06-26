<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 20.06.2017
 * Time: 13:44
 */

namespace nofuture17\seo_filter\Filter;


use nofuture17\seo_filter\Common\ArrayAccessInterface;
use nofuture17\seo_filter\Common\ConfigurableInterface;
use nofuture17\seo_filter\Traits\ArrayAccess;
use nofuture17\seo_filter\Traits\Configure;

class Data implements DataInterface, ArrayAccessInterface, ConfigurableInterface
{
    use Configure;
    use ArrayAccess;

    public $name = '';
    public $url = '';
    public $baseUrl = '';
    public $h1 = '';
    public $title = '';
    public $text = '';
    public $fieldsData = [];
    public $rules = [];

    public static $accessibleProperties = [
        'name',
        'url',
        'baseUrl',
        'h1',
        'title',
        'text'
    ];

    public function getArrayAccessFields()
    {
        return self::$accessibleProperties;
    }

    public function getConfigurableFields()
    {
        return self::$accessibleProperties;
    }

    /**
     * @inheritdoc
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->set($data);
        }
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getH1()
    {
        return $this->h1;
    }

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @inheritdoc
     */
    public function getFieldsData()
    {
        return $this->fieldsData;
    }

    /**
     * @inheritdoc
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @inheritdoc
     */
    public function set(array $data)
    {
        if (isset($data['rules'])) {
            if (is_string($data['rules'])) {
                $this->rules = preg_split('/;\s+?/', $data['rules']);
            } elseif (is_array($data['rules'])) {
                $this->rules = $data['rules'];
            }
            unset($data['rules']);
        }

        if (isset($data['fields'])) {
            if (is_array($data['fields'])) {
                $this->fieldsData = $data['fields'];
            }
            unset($data['fields']);
        }
        $this->configure($data);
    }
}