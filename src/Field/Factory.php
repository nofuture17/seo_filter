<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 22.06.2017
 * Time: 7:19
 */

namespace nofuture17\seo_filter\Field;


use nofuture17\seo_filter\Common\Set;

class Factory
{
    public static $config = [
        'fields' => [
            'checkbox' => [
                'class' => FieldVariable::class,
                'valueClass' => Value::class,
            ],
            'radio' => [
                'class' => FieldVariable::class,
                'valueClass' => Value::class,
                'valueIsOnce' => true,
            ],
            'select' => [
                'class' => FieldVariable::class,
                'valueClass' => Value::class,
                'valueIsOnce' => true,
            ],
            'range' => [
                'class' => FieldRange::class,
                'valueClass' => Value::class
            ],
        ],
    ];

    /**
     * Создаёт поле фильтра из данных
     * @param array $fieldData
     * @param array $config Настройки классов поля и значения
     * @throws \Exception
     * @return FieldInterface
     */
    public static function create($fieldData, $config = [])
    {
        if (!empty($fieldData['type'])) {
            if (!empty($config) || !empty(self::$config['fields'][$fieldData['type']])) {
                $fieldConfig = !empty($config) ? $config : self::$config['fields'][$fieldData['type']];
                $fieldClass = $fieldConfig['class'];
                $fieldValueClass = $fieldConfig['valueClass'];
                $value = new $fieldValueClass ();
                /**
                 * @var $value Value
                 */
                if (isset($fieldConfig['valueIsOnce'])) {
                    $value->setIsOnce($fieldConfig['valueIsOnce']);
                }
                return new $fieldClass($fieldData, $value);
            } else {
                throw new \Exception('Field class not found');
            }
        } else {
            var_dump($fieldData);die;
            throw new \Exception('Invalid data');
        }
    }

    /**
     * Создаёт множество полей фильтра из данных
     * @param array $fieldsData
     * @param array $config Настройки классов поля и значения
     * @throws \Exception
     * @return Set
     */
    public static function createSet($fieldsData, $config = [])
    {
        $fields = new Set();
        foreach ($fieldsData as $fieldData) {
            $fieldConfig = [];

            if (!empty($config[$fieldData['url']])) {
                $fieldConfig = $config[$fieldData['url']];
            } elseif (!empty($config[$fieldData['type']])) {
                $fieldConfig = $config[$fieldData['type']];
            }

            if ($field = self::create($fieldData, $fieldConfig)) {
                $fields->addItem($field);
            }
        }

        $fields->reorder();
        return $fields;
    }
}