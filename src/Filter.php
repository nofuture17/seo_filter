<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 01.06.2017
 * Time: 22:03
 */

namespace nofuture17\seo_filter;


use nofuture17\seo_filter\Traits\Configure;

class Filter
{
    use Configure;

    const EXCEPTION_CODE_INVALID_NAME = 1;
    const EXCEPTION_CODE_INVALID_URL = 2;

    public $fieldFactoryClassName = '\nofuture17\seo_filter\FieldFactory';
    public $fieldsSetClassName = '\nofuture17\seo_filter\SetFields';

    /**
     * @var SetFields
     */
    public $fields;
    public $name;
    public $url;
    public $text;
    public $fieldsSet;

    public function __construct($data, $config = [])
    {
        $this->init($data, $config);
    }

    protected function init($data, $config)
    {
        $this->configure($config);
        $this->initComponents();
        $this->setData($data);

        return true;
    }

    protected function initComponents()
    {
        $this->fields = new $this->fieldsSetClassName ();
    }

    /**
     * @param Data $data
     * @throws \Exception
     */
    protected function setData($data)
    {
        if (empty($data->name)) {
            throw new \Exception('Необходимо задать имя фильтра', self::EXCEPTION_CODE_INVALID_NAME);
        } else {
            $this->name = $data->name;
        }

        if (empty($data->url)) {
            throw new \Exception('Необходимо задать url фильтра', self::EXCEPTION_CODE_INVALID_URL);
        } else {
            $this->url = $data->url;
        }

        if (!empty($data->text)) {
            $this->text = $data->text;
        }

        if (!empty($data->fields)) {
            $this->setFields($data->fields);
        }
    }

    public function setValue(ValueFilter $value)
    {

    }

    public function getFields($order = null, $ignoreFieldsSet = false)
    {
        $result = [];

        $fields = $this->fields->getItems($order);

        if (!$ignoreFieldsSet && !empty($this->fieldsSet) && is_array($this->fieldsSet)) {
            foreach ($fields as $field) {
                if (in_array($field['url'], $this->fieldsSet)) {
                    $result[$field['url']] = $field;
                }
            }
        }

        return $result;
    }

    public function setFields($fieldsData)
    {
        if (!empty($fieldsData)) {
           foreach ($fieldsData as $fieldData) {
                $this->setField($fieldData);
            }
            $this->fields->reorder();
        }
    }

    public function setField($fieldData)
    {
        $field = call_user_func_array(
            [$this->fieldFactoryClassName, 'create'],
            ['data' => $fieldData]
        );

        $this->fields->addItem($field, false);
    }
}