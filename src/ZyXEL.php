<?php

namespace jwdr\ZyXEL;

use jwdr\ZyXEL\Output\ArpHost;
use jwdr\ZyXEL\Output\Exceptions\FieldCountDoesNotMatchHeader;
use jwdr\ZyXEL\Output\Exceptions\IsHeaderRecord;
use jwdr\ZyXEL\Output\ArpHosts;
use jwdr\ZyXEL\Output\LanHosts;
class ZyXEL
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function help()
    {
        return $this->connection->executeCommand('help');
    }

    /**
     * Returns a list of hosts that are known to have been connected to the ZyXEL
     * There is no guarantee that any of these devices are currently connected
     *
     * @return LanHosts
     */
    public function lanHosts()
    {
        $rawData = $this->connection->executeCommand('lanhosts show all');

        return LanHosts::fromRawData($rawData);
    }

    /**
     *
     */
    public function arp()
    {
        $rawData = $this->connection->executeCommand('arp show');

        return ArpHosts::fromRawData($rawData);
    }
}
