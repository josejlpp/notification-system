<?php

namespace Core\Publisher;

use ArrayIterator;
use Core\Publisher\Contracts\IPublisherAdapter;
use IteratorAggregate;
class PublisherCollection implements IteratorAggregate
{
    private array $items = [];

    public function addPublisher(string $key, IPublisherAdapter $adapter)
    {
        $this->items[$key] = $adapter;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function count()
    {
        return $this->getIterator()->count();
    }

    public function getPublisher(string $key)
    {
        return $this->getIterator()->offsetExists($key) ? $this->getIterator()->offsetGet($key) : null;
    }
}
