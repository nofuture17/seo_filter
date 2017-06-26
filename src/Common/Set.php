<?php
/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 22.06.2017
 * Time: 10:38
 */

namespace nofuture17\seo_filter\Common;


use nofuture17\seo_filter\Field\FieldInterface;
use nofuture17\seo_filter\Field\VariantInterface;
use nofuture17\seo_filter\Filter\ValueInterface;
use nofuture17\seo_filter\Traits\SetItem;

class Set implements \Iterator
{
    public $defaultOrder = 'priority';

    protected $items = [];
    protected $orders = [
        'url' => [],
        'priority' => []
    ];

    public function setDefaultOrder($order)
    {
        if (isset($this->orders[$order])) {
            $this->defaultOrder = $order;
        }
        return $this;
    }

    public function getDefaultOrderList()
    {
        if (isset($this->orders[$this->defaultOrder])) {
            $this->orders[$this->defaultOrder];
        }
        return null;
    }

    /**
     * Добавить поле в набор
     * @param $item FieldInterface
     * @param bool $reorder
     * @return $this
     */
    public function addItem($item, $reorder = true)
    {
        $this->items[$item['url']] = $item;

        if ($reorder) {
            $this->reorder();
        }

        return $this;
    }

    public function addItems($items, $reorder = true)
    {
        if (!empty($items)) {
            foreach ($items as $item) {
                $this->addItem($item, false);
            }
            if ($reorder) {
                $this->reorder();
            }
        }

        return $this;
    }

    /**
     * @param $url
     * @return VariantInterface|FieldInterface|SetItem|null
     */
    public function getItem($url)
    {
        $result = null;

        if ($this->hasItem($url)) {
            $result = $this->items[$url];
        }

        return $result;
    }

    public function hasItem($url)
    {
        return !empty($this->items[$url]);
    }

    public function reorder()
    {
        $this->sortItems('url');
        $this->sortItems('priority');
        return $this;
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

                if ((int)$a[$param] < (int)$b[$param]) {
                    return 1;
                } elseif ((int)$a[$param] == (int)$b[$param]) {
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

        return $this;
    }

    public function getItemsParamsAsArray($param, $order = null)
    {
        $result = [];

        foreach ($this->getItems($order) as $item) {
            $result[] = $item[$param];
        }

        return $result;
    }

    /**
     * @param null $order
     * @return VariantInterface[]|FieldInterface[]|null
     */
    public function getItems($order = null)
    {
        if (empty($order) || empty($this->orders[$order])) {
            $order = $this->defaultOrder;
        }

        $result = [];

        foreach ($this->orders[$order] as $itemUrl) {
            if ($item = $this->getItem($itemUrl)) {
                $result[$itemUrl] = $item;
            }
        }

        return $result;
    }

    public function current()
    {
        if ($this->key() !== null) {
            return $this->getItem($this->key());
        }
        return false;
    }

    public function key()
    {
        $key = current($this->orders[$this->defaultOrder]);
        return $key !== false ? $key : null;
    }

    public function next()
    {
        next($this->orders[$this->defaultOrder]);
    }

    public function rewind()
    {
        reset($this->orders[$this->defaultOrder]);
    }

    public function valid()
    {
        return null !== $this->key();
    }
}