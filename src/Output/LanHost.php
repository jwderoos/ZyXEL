<?php

namespace jwdr\ZyXEL\Output;

use jwdr\ZyXEL\Output\Exceptions\HeaderNotSet;
use jwdr\ZyXEL\Output\Exceptions\IsBridgeRecord;
use jwdr\ZyXEL\Output\Exceptions\IsHeaderRecord;
use jwdr\ZyXEL\ValueObjects\MacAddress;
use ValueObjects\Number\Integer;
use ValueObjects\Web\Hostname;
use ValueObjects\Web\IPAddress;

class LanHost
{
    private $macAddress;
    private $ipAddress;
    private $leaseTimeOut;
    private $hostName;

    /**
     * @var array
     */
    private static $header;

    public static function fromRawData($record)
    {
        if (self::isBridge($record)) throw new IsBridgeRecord();

        $record = self::cleanup($record);
        $fields = explode("  ", $record);

        if (self::isHeader($fields)) {
            //set header
            self::$header = $fields;
            throw new IsHeaderRecord();
        }

        if (self::$header === null) {
            throw new HeaderNotSet('Header not set');
        }

        $fields = array_combine(self::$header, $fields);

        $mac = $fields['MAC Addr'];
        $ip = $fields['IP Addr'];
        $lease = $fields['Lease Time Remaining'];
        $host = $fields['Hostname'];

        $macAddress = new MacAddress($mac);
        $ipAddress = new IPAddress($ip);
        $leaseTimeOut = new Integer($lease);
        $hostName = new Hostname($host);

        return new self($macAddress, $ipAddress, $leaseTimeOut, $hostName);
    }

    protected static function isBridge($rawRecord)
    {
        return (preg_match('/Bridge br/', $rawRecord) == 1);
    }

    protected static function isHeader($fields)
    {
        return $fields[0] === 'MAC Addr';
    }

    protected static function cleanup($record)
    {
        $record = preg_replace(['/^\s+/','/\s\s+/'], ['', '  '], $record);
        return $record;
    }

    function __construct(MacAddress $macAddress, IPAddress $IPAddress, Integer $leaseTimeOut, Hostname $hostName)
    {
        $this->macAddress = $macAddress;
        $this->ipAddress = $IPAddress;
        $this->leaseTimeOut = $leaseTimeOut;
        $this->hostName = $hostName;
    }
}