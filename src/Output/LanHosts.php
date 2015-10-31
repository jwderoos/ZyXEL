<?php

namespace jwdr\ZyXEL\Output;

use jwdr\ZyXEL\Output\Exceptions\IsBridgeRecord;
use jwdr\ZyXEL\Output\Exceptions\IsHeaderRecord;
use Rhumsaa\Uuid\Console\Exception;
class LanHosts
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


}