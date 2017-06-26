<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 22.06.2017
 * Time: 20:53
 */

namespace nofuture17\seo_filter\Field;


use nofuture17\seo_filter\Common\Set;
use nofuture17\seo_filter\Traits\SetItem;

/**
 * @property Set $inputData
 * Class FieldVariable
 * @package nofuture17\seo_filter\Field
 */
class FieldVariable extends Field
{
    /**
     * @inheritdoc
     */
    public function validateValue($data)
    {
        $result = [];

        if (!empty($data)) {
            if (is_array($data)) {
                foreach ($data as $item) {
                    $variant = $this->getInputsData()->getItem($item);
                    if (!empty($variant) && $variant->getActive() == SetItem::getActiveArray()['active']) {
                        $result[] = $item;
                    }
                }
            } elseif ($this->getInputsData()->hasItem($data)) {
                $result = $data;
            }
        }

        return !empty($result) ? $result : null;
    }

    /**
     * @inheritdoc
     */
    public function setInputsData(array $inputsData)
    {
        if (!empty($inputsData)) {
            foreach ($inputsData as $inputData) {
                $input = new Variant($inputData);
                $this->getInputsData()->addItem($input);
            }
        }

        return $this;
    }

    /**
     * @inheritdoc
     * @return Set
     */
    public function getInputsData()
    {
        if (empty($this->inputData)) {
            $this->inputData = new Set();
        }

        return $this->inputData;
    }
}