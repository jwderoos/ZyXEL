<?php

namespace jwdr\ZyXEL\Output;

use jwdr\ZyXEL\Output\Exceptions\IsBridgeRecord;
use jwdr\ZyXEL\Output\Exceptions\IsHeaderRecord;
use Rhumsaa\Uuid\Console\Exception;
class LanHosts implements \ArrayAccess, \Iterator
{
    /**
     * @var array|LanHost[]
     */
    private $lanHosts;

    /**
     * @param string[] $rawData
     * @return LanHosts
     */
    public static function fromRawData($rawData){
        $lanHosts = new self();
        $lanHosts->addLanHostsFromRawData($rawData);
        return $lanHosts;
    }

    public function __construct()
    {
        $this->lanHosts = [];
    }

    /**
     * @param string[] $rawData
     */
    protected function addLanHostsFromRawData($rawData)
    {
        foreach ($rawData as $rawRecord) {
            $this->addLanHostFromRaw($rawRecord);
        }
    }

    /**
     * @param string $rawRecord
     */
    protected function addLanHostFromRaw($rawRecord)
    {
        try {
            $lanHost = LanHost::fromRawData($rawRecord);
            $this->addLanHost($lanHost);
        } catch (IsBridgeRecord $e) {

        } catch (IsHeaderRecord $e) {

        }
    }

    /**
     * @param LanHost $lanHost
     * @return $this
     */
    public function addLanHost(LanHost $lanHost)
    {
        if (!in_array($lanHost, $this->lanHosts)) {
            $this->lanHosts[] = $lanHost;
        }

        return $this;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->lanHosts);
    }

    /**
     * @param mixed $offset
     * @return LanHost
     */
    public function offsetGet($offset)
    {
        return $this->lanHosts[$offset];
    }

    /**
     * @param mixed $offset
     * @param LanHost $value
     */
    public function offsetSet($offset, $value)
    {
        $this->lanHosts[$offset] = $value;
    }


    public function offsetUnset($offset)
    {
        unset($this->lanHosts[$offset]);
    }

    /**
     * @return LanHost
     */
    public function current()
    {
        return current($this->lanHosts);
    }

    public function next()
    {
        next($this->lanHosts);
    }

    public function key()
    {
        return key($this->lanHosts);
    }

    public function valid()
    {
        return $this->offsetExists($this->key());
    }

    public function rewind()
    {
        reset($this->lanHosts);
    }
}