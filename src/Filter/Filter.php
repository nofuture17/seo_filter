<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 20.06.2017
 * Time: 13:40
 */

namespace nofuture17\seo_filter\Filter;

use nofuture17\seo_filter\Common\ArrayAccessInterface;
use nofuture17\seo_filter\Common\ConfigurableInterface;
use nofuture17\seo_filter\Common\Set;
use nofuture17\seo_filter\Field\Field;
use nofuture17\seo_filter\Field\FieldInterface;
use nofuture17\seo_filter\Traits\ArrayAccess;
use nofuture17\seo_filter\Traits\Configure;
use nofuture17\seo_filter\Traits\SEOItem;
use nofuture17\seo_filter\Traits\SetItem;

class Filter implements FilterInterface, ArrayAccessInterface, ConfigurableInterface
{
    use Configure,
        ArrayAccess,
        SEOItem {
        SEOItem::getArrayAccessFields as SEOItemGetArrayAccessFields;
        SEOItem::getConfigurableFields as SEOItemGetConfigurableFields;
    }

    protected $config = [];

    public $baseUrl;
    public $fields;
    public $rules;
    public $text;

    public function getConfigurableFields()
    {
        return array_merge(
            $this->SEOItemGetConfigurableFields(),
            ['baseUrl']
        );
    }

    public function getArrayAccessFields()
    {
        return array_merge(
            $this->SEOItemGetArrayAccessFields(),
            ['baseUrl']
        );
    }

    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @inheritdoc
     */
    public function setConfig(array $config)
    {
        if (!empty($config)) {
            array_merge($this->config, $config);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setData(DataInterface $data)
    {
        $this->configure($data);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setFields(Set $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFields()
    {
        return $this->fields;
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
    public function setRules($rules)
    {
        $this->rules = $rules;
        return $this;
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
    public function setValue(ValueInterface $value)
    {
        $fieldsValues = $value->get();
        if (!empty($fieldsValues)) {
            foreach ($fieldsValues as $fieldName => $fieldValue) {
                if ($field = $this->getFields()->getItem($fieldName)) {
                    $field->setValue($fieldValue);
                }
            }
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        $value = new Value();
        foreach ($this->getFields() as $fieldUrl => $field) {
            if ($field->getActive() == SetItem::getActiveArray()['active']) {
                $value->addFormArray([$fieldUrl => $field->getValue()->toArray()]);
            }
        }
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function implementRules()
    {
        // TODO: Implement implementRules() method.
        return $this;
    }
}