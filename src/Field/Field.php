<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 21.06.2017
 * Time: 10:26
 */

namespace nofuture17\seo_filter\Field;

use nofuture17\seo_filter\Common\ArrayAccessInterface;
use nofuture17\seo_filter\Common\ConfigurableInterface;
use nofuture17\seo_filter\Traits\ArrayAccess;
use nofuture17\seo_filter\Traits\Configure;
use nofuture17\seo_filter\Traits\SEOItem;
use nofuture17\seo_filter\Traits\SetItem;

abstract class Field implements FieldInterface, SetItemInterface, ArrayAccessInterface, ConfigurableInterface
{
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_RADIO = 'radio';
    const TYPE_RANGE = 'range';
    const TYPE_SELECT = 'select';

    use ArrayAccess, Configure, SEOItem, SetItem {
        SEOItem::getArrayAccessFields as SEOItemGetArrayAccessFields;
        SetItem::getArrayAccessFields as SetItemGetArrayAccessFields;
        SEOItem::getConfigurableFields as SEOItemGetConfigurableFields;
        SetItem::getConfigurableFields as SetItemGetConfigurableFields;
    }

    protected $inputData;
    protected $value;

    public function __construct(array $fieldData, $value = null)
    {
        $this->configure($fieldData);
        $this->setInputsData($fieldData['data']);
        $this->initValue($value);
    }

    protected function initValue($value)
    {
        if (!empty($value)) {
            $this->value = $value;
        }
    }

    public function getArrayAccessFields()
    {
        return array_merge(
            $this->SEOItemGetArrayAccessFields(),
            $this->SetItemGetArrayAccessFields()
        );
    }

    public function getConfigurableFields()
    {
        return array_merge(
            $this->SEOItemGetConfigurableFields(),
            $this->SetItemGetConfigurableFields()
        );
    }

    /**
     * @inheritdoc
     * @return self
     */
    public function setValue($data)
    {
        $value = $this->getValue();
        $value->set($this->validateValue($data));
        return $this;
    }

    /**
     * @inheritdoc
     * @return Value
     */
    public function getValue()
    {
        if (!isset($this->value)) {
            $this->value = new Value();
        }

        return $this->value;
    }

    /**
     * Фильтрация и проверка устанавливаемого значения
     * @param $data
     * @return mixed|null
     */
    abstract public function validateValue($data);

    /**
     * @inheritdoc
     */
    abstract public function setInputsData(array $inputsData);

    /**
     * @inheritdoc
     */
    abstract public function getInputsData();
}