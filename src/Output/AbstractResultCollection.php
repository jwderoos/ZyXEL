<?php

namespace jwdr\ZyXEL\Output;

abstract class AbstractResultCollection implements \ArrayAccess, \Iterator
{
    /**
     * @var array|AbstractResult[]
     */
    private $results;

    public function __construct()
    {
        $this->results = [];
    }

    /**
     * @param mixed $offset
     * @return AbstractResult
     */
    public function offsetGet($offset)
    {
        return $this->results[$offset];
    }

    /**
     * @param mixed $offset
     * @param AbstractResult $value
     */
    public function offsetSet($offset, $value)
    {
        $this->results[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->results[$offset]);
    }

    /**
     * @return AbstractResult
     */
    public function current()
    {
        return current($this->results);
    }

    public function next()
    {
        next($this->results);
    }

    public function valid()
    {
        return $this->offsetExists($this->key());
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->results);
    }

    public function key()
    {
        return key($this->results);
    }

    public function rewind()
    {
        reset($this->results);
    }

    public function addOnce(AbstractResult $result)
    {
        if (!$this->contains($result)) {
            $this->add($result);
        }
    }

    public function contains(AbstractResult $result)
    {
        return in_array($result, $this->results);
    }

    public function add(AbstractResult $result)
    {
        $this->results[] = $result;
    }
}