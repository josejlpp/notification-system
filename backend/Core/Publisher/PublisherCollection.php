<?php

namespace Core\Publisher;

use ArrayIterator;
use Core\Publisher\Contracts\IPublisherAdapter;
use IteratorAggregate;
class PublisherCollection implements IteratorAggregate
{
    private array $items = [];

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function add(string $key, IPublisherAdapter $adapter)
    {
        $this->items[$key] = $adapter;
    }

    public function count()
    {
        return $this->getIterator()->count();
    }

    public function getPublisher(string $key)
    {
        return $this->getIterator()->offsetGet($key) ?? false;
    }
}
