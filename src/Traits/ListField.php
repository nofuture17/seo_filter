<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 13.06.17
 * Time: 15:41
 */

namespace nofuture17\seo_filter\Traits;


use nofuture17\seo_filter\FieldListItem;
use nofuture17\seo_filter\SetInputData;

trait ListField
{
    public function setInputData($data)
    {
        if (!($this->inputData instanceof SetInputData)) {
            $this->inputData = new SetInputData();
        }

        foreach ($data as $datum) {
            $inputDataItem = new FieldListItem($datum);
            if ($inputDataItem->isValid()) {
                $this->inputData->addItem($inputDataItem, false);
            }
        }
        $this->inputData->reorder();
    }
}