<?php

namespace jwdr\ZyXEL;

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

    public function lanHosts()
    {
        $rawData = $this->connection->executeCommand('lanhosts show all');
        unset($rawData[0]);
        return LanHosts::fromRawData($rawData);
    }
}
