<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 22.06.2017
 * Time: 20:53
 */

namespace nofuture17\seo_filter\Field;


class FieldRange extends Field
{

    /**
     * @inheritdoc
     */
    public function validateValue($data)
    {
        $result = null;

        if (is_array($data)) {
            $min = array_shift($data);
            $max = array_shift($data);

            if (
                $this->inputData['isRange'] && is_numeric($min) && is_numeric($max)
                && $min >= $this->inputData['min'] && ($min % $this->inputData['step']) == 0
                && $max <= $this->inputData['max'] && ($min % $this->inputData['step']) == 0
            ) {
                $result = [
                    'min' => $min,
                    'max' => $max,
                ];
            }
        } elseif (
            !$this->inputData['isRange']
            && is_numeric($data) && ($data % $this->inputData['step']) == 0
        ) {
            $result = $data;
        }

        return $result;
    }

    /**
     * @param $value Value
     */
    public function initValue($value)
    {
        $value->setIsOnce(empty($this->inputData['isRange']));
        parent::initValue($value);
    }

    /**
     * @inheritdoc
     */
    public function setInputsData(array $inputsData)
    {
        $this->inputData = [
            'min'       => $inputsData['min'],
            'max'       => $inputsData['max'],
            'step'      => $inputsData['step'],
            'unit'      => $inputsData['unit'],
            'isRange'   => !empty($inputsData['isRange']) ? true : false
        ];

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getInputsData()
    {
        return $this->inputData;
    }
}