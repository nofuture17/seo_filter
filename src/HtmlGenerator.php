<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 15.06.17
 * Time: 13:14
 */

namespace nofuture17\seo_filter;


use HtmlGenerator\HtmlTag;

class HtmlGenerator
{
    public $filter;
    public $filterClass = 'filter-form';
    public $fieldClass = 'filter-form-field';
    public $fieldInputClass = 'filter-form-field-input';
    public $fieldInputIdPrefix = 'input';

    public function __construct(Filter $filter)
    {
        $this->filter = $filter;
    }

    public function getHtml()
    {
        $html = $this->getFilterHtml($this->filter);

        return $html;
    }

    public function getFilterHtml()
    {
        $html = HtmlTag::createElement("div");
        $html->addClass($this->filterClass)
            ->attr('data-base-url', $this->filter->getBaseUrl())
            ->attr('data-current-url', $this->filter->getCurrentUrl());

        $headerHtml = $html->addElement('div');
        $headerHtml->addClass($this->filterClass . '__header')
            ->addElement('div')
            ->addClass($this->filterClass . '__label')->text($this->filter->name);

        $html->addElement($this->getFilterContentHtml());

        $html->addElement('div')
            ->addClass($this->filterClass . '__footer');

        return $html;
    }

    public function getFilterContentHtml()
    {
        $html = HtmlTag::createElement('div');
        $html->addClass($this->filterClass . '__content');

        $fields = $this->filter->fields->getItems();
        if (!empty($fields)) {
            foreach ($fields as $field) {
                if ($fieldHtml = $this->getFieldHtml($field)) {
                    $html->addElement($fieldHtml);
                }
            }
        }

        return $html;
    }

    public function getFieldHtml(Field $field)
    {
        $result = null;

        $html = HtmlTag::createElement('div');
        $html->addClass($this->fieldClass)
            ->addClass($this->fieldClass . '--' . $field->type)
            ->attr('data-url', $field->url)
            ->attr('data-type', $field->type)
            ->attr('data-priority', $field->priority)
            ->attr('data-active', $field->active)
            ->addElement('div')->addClass($this->fieldClass . '__header')
            ->addElement('div')->addClass($this->fieldClass . '__label')
            ->text($field->name);

        switch ($field->type) {
            case FieldFactory::TYPE_CHECKBOX:
                $content = $this->getFieldCheckboxContent($field);
                break;
            case FieldFactory::TYPE_SELECT:
                $content = $this->getFieldSelectContent($field);
                break;
            case FieldFactory::TYPE_RADIO:
                $content = $this->getFieldRadioContent($field);
                break;
            case FieldFactory::TYPE_RANGE:
                $content = $this->getFieldRangeContent($field);
                break;
        }

        if (!empty($content)) {
            $html->addElement($content);
            $html->addElement('div')->addClass($this->fieldClass . '__footer');
            $result = $html;
        }

        return $result;
    }

    public function getFieldContentContainer()
    {
        $result = HtmlTag::createElement('div')
            ->addClass($this->fieldClass . '__content');
        return $result;
    }

    public function getFieldCheckboxContent(FieldCheckbox $field)
    {
        if (empty($field->inputData) || $field->inputData->isEmpty()) {
            return null;
        }

        $container = $this->getFieldContentContainer();
        $inputs = $field->inputData->getItems();

        foreach ($inputs as $input) {
            $inputId = "{$this->fieldInputIdPrefix}-{$field->url}-{$input->url}";
            $inputHtml = HtmlTag::createElement('div')
                ->addClass($this->fieldInputClass)
                ->attr('data-url', $input->url)
                ->attr('data-start-value', '');

            $inputHtml->addElement('input')
                ->addClass($this->fieldInputClass . '__input')
                ->attr('type', 'checkbox')
                ->attr('value', $input->url)
                ->attr('id', $inputId);

            $inputHtml->addElement('label')
                ->addClass($this->fieldInputClass . '__label')
                ->attr('for', $inputId)
                ->addElement('div')
                ->addClass($this->fieldInputClass . '__label-text')
                ->text($input->name);

            $container->addElement($inputHtml);
        }

        return $container;
    }

    public function getFieldSelectContent(Field $field)
    {

    }

    public function getFieldRadioContent(Field $field)
    {

    }

    public function getFieldRangeContent(Field $field)
    {

    }
}