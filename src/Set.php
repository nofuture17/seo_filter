<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 09.06.2017
 * Time: 6:15
 */

namespace nofuture17\seo_filter;


class Set
{
    public $itemsSet = 'all';
    public $defaultOrder = 'priority';

    protected $items = [];
    protected $orders = [
        'url' => [],
        'priority' => []
    ];

    public function addItem($item, $reorder = true)
    {
        if (is_array($this->itemsSet) && !in_array($item['url'], $this->itemsSet)){
            return null;
        }

        $this->items[$item['url']] = $item;

        if ($reorder) {
            $this->reorder();
        }
    }

    public function reorder()
    {
        $this->sortItems('url');
        $this->sortItems('priority');
    }

    public function sortItems($param)
    {
        $order = [];
        $items = $this->items;

        usort(
            $items,
            function ($a, $b) use ($param) {
                if (empty($a) || empty($a[$param]) || !is_numeric($a[$param])) {
                    return -1;
                }
                if (empty($b) || empty($b[$param]) || !is_numeric($b[$param])) {
                    return 1;
                }

                if ((int) $a[$param] < (int) $b[$param]) {
                    return 1;
                } elseif ((int) $a[$param] == (int) $b[$param]) {
                    return 0;
                } else {
                    return -1;
                }
            }
        );

        foreach ($items as $item) {
            $order[] = $item['url'];
        }

        $this->orders[$param] = $order;

        return $order;
    }

    public function getItemsParamsAsArray($param, $order = null)
    {
        $result = [];

        foreach ($this->getItems($order) as $item) {
            $result[] = $item[$param];
        }

        return $result;
    }

    public function getItems($order = null)
    {
        if (empty($order) || empty($this->orders[$order])) {
            $order = $this->defaultOrder;
        }

        $result = [];

        foreach ($this->orders[$order] as $itemUrl) {
            if (!empty($this->items[$itemUrl])) {
                $result[$itemUrl] = $this->items[$itemUrl];
            }
        }

        return $result;
    }
}