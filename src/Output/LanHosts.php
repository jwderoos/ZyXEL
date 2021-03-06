<?php

namespace jwdr\ZyXEL\Output;

use jwdr\ZyXEL\Output\Exceptions\FieldCountDoesNotMatchHeader;
use jwdr\ZyXEL\Output\Exceptions\IsHeaderRecord;
class LanHosts extends AbstractResultCollection
{

    /**
     * @param string[] $rawData
     * @return LanHosts
     */
    public static function fromRawData($rawData)
    {
        $lanHosts = new self();
        $lanHosts->addLanHostsFromRawData($rawData);

        return $lanHosts;
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
        } catch (FieldCountDoesNotMatchHeader $e) {
        } catch (IsHeaderRecord $e) {
        }
    }

    /**
     * @param LanHost $lanHost
     * @return $this
     */
    public function addLanHost(LanHost $lanHost)
    {
        $this->addOnce($lanHost);

        return $this;
    }

    /**
     * @param mixed $offset
     * @return LanHost
     */
    public function offsetGet($offset)
    {
        return parent::offsetGet($offset);
    }

    /**
     * @return LanHost
     */
    public function current()
    {
        return parent::current();
    }
}