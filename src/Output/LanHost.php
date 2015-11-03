<?php

namespace jwdr\ZyXEL\Output;

use jwdr\ZyXEL\ValueObjects\MacAddress;
use ValueObjects\Number\Integer;
use ValueObjects\Web\Hostname;
use ValueObjects\Web\IPAddress;

class LanHost extends AbstractResult
{
    /**
     * @var MacAddress
     */
    private $macAddress;
    /**
     * @var IPAddress
     */
    private $ipAddress;
    /**
     * @var Integer
     */
    private $leaseTimeOut;
    /**
     * @var Hostname
     */
    private $hostName;

    function __construct(MacAddress $macAddress, IPAddress $IPAddress, Integer $leaseTimeOut, Hostname $hostName)
    {
        $this->macAddress   = $macAddress;
        $this->ipAddress    = $IPAddress;
        $this->leaseTimeOut = $leaseTimeOut;
        $this->hostName     = $hostName;
    }

    public static function fromRawData($rawData)
    {
        $fields = parent::prepareFields($rawData);

        $mac   = $fields['MAC Addr'];
        $ip    = $fields['IP Addr'];
        $lease = $fields['Lease Time Remaining'];
        $host  = $fields['Hostname'];

        $macAddress   = new MacAddress($mac);
        $ipAddress    = new IPAddress($ip);
        $leaseTimeOut = new Integer($lease);
        $hostName     = new Hostname($host);

        return new self($macAddress, $ipAddress, $leaseTimeOut, $hostName);
    }

    public static function isHeader($fields)
    {
        return $fields[0] === 'MAC Addr';
    }

    protected static function isBridge($rawRecord)
    {
        return (preg_match('/Bridge br/', $rawRecord) == 1);
    }

    /**
     * @return MacAddress
     */
    public function getMacAddress()
    {
        return $this->macAddress;
    }

    /**
     * @return IPAddress
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @return int
     */
    public function getLeaseTimeOut()
    {
        return $this->leaseTimeOut;
    }

    /**
     * @return Hostname
     */
    public function getHostName()
    {
        return $this->hostName;
    }

}