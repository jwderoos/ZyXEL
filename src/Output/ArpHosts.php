<?php

namespace jwdr\ZyXEL\Output;

use jwdr\ZyXEL\Output\Exceptions\FieldCountDoesNotMatchHeader;
use jwdr\ZyXEL\Output\Exceptions\IsHeaderRecord;
class ArpHosts extends AbstractResultCollection
{

    /**
     * @param string[] $rawData
     * @return ArpHosts
     */
    public static function fromRawData($rawData)
    {
        $ArpHosts = new self();
        $ArpHosts->addArpHostsFromRawData($rawData);

        return $ArpHosts;
    }

    /**
     * @param string[] $rawData
     */
    protected function addArpHostsFromRawData($rawData)
    {
        foreach ($rawData as $rawRecord) {
            $this->addArpHostFromRaw($rawRecord);
        }
    }

    /**
     * @param string $rawRecord
     */
    protected function addArpHostFromRaw($rawRecord)
    {
        try {
            $ArpHost = ArpHost::fromRawData($rawRecord);
            $this->addArpHost($ArpHost);
        } catch (FieldCountDoesNotMatchHeader $e) {
        } catch (IsHeaderRecord $e) {
        }
    }

    /**
     * @param ArpHost $ArpHost
     * @return ArpHosts
     */
    public function addArpHost(ArpHost $ArpHost)
    {
        $this->addOnce($ArpHost);

        return $this;
    }

    /**
     * @param mixed $offset
     * @return ArpHost
     */
    public function offsetGet($offset)
    {
        return parent::offsetGet($offset);
    }

    /**
     * @return ArpHost
     */
    public function current()
    {
        return parent::current();
    }
}