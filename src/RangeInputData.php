<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 15.06.17
 * Time: 11:39
 */

namespace nofuture17\seo_filter;


class RangeInputData
{
    const EXCEPTION_CODE_INVALID_MAX = 1;
    const EXCEPTION_CODE_INVALID_STEP = 2;
    const EXCEPTION_CODE_INVALID_DATA = 5;

    public $min;
    public $max;
    public $step;
    public $unit;

    public function __construct($data = null)
    {
        if (!empty($data)) {
            $this->set($data);
        }
    }

    public function set($data)
    {
        if (empty($data)) {
            throw new \Exception('Нет данных', self::EXCEPTION_CODE_INVALID_DATA);
        }

        $this->min = empty($data['min']) ? $data['min'] : 0;

        if (empty($data['max'])) {
            throw new \Exception('Не задано максимальное значение', self::EXCEPTION_CODE_INVALID_MAX);
        } else {
            $this->max = $data['max'];
        }

        if ($data['step'] <= 0) {
            throw new \Exception('Шаг не может быть меньше или равен нулю', self::EXCEPTION_CODE_INVALID_STEP);
        } elseif ($data['step'] > $this->max) {
            throw new \Exception('Шаг не может быть больше максимального значения', self::EXCEPTION_CODE_INVALID_STEP);
        }
        $this->step = !empty($data['step']) && is_numeric($data['step']) ? $data['step'] : $this->max;
    }
}