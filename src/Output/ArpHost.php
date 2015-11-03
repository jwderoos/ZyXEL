<?php

namespace jwdr\ZyXEL\Output;

use jwdr\ZyXEL\ValueObjects\MacAddress;
use ValueObjects\Number\Integer;
use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Web\IPAddress;
class ArpHost extends AbstractResult
{
    /** @var IPAddress */
    private $ipAddress;
    /** @var Integer */
    private $hardwareType;
    /** @var Integer */
    private $flags;
    /** @var  MacAddress */
    private $macAddress;
    /** @var  StringLiteral */
    private $mask;
    /** @var  StringLiteral */
    private $device;

    function __construct(
        IPAddress $IpAddress,
        Integer $hardwareType,
        Integer $flags,
        MacAddress $macAddress,
        StringLiteral $mask,
        StringLiteral $device
    ) {
        $this->ipAddress    = $IpAddress;
        $this->hardwareType = $hardwareType;
        $this->flags        = $flags;
        $this->macAddress   = $macAddress;
        $this->mask         = $mask;
        $this->device       = $device;
    }

    static public function fromRawData($rawData)
    {
        $fields = parent::prepareFields($rawData);
        
        $ip        = new IPAddress($fields['IP address']);
        $hwType    = new Integer(hexdec($fields['HW type']));
        $flags     = new Integer(hexdec($fields['Flags']));
        $hwAddress = new MacAddress($fields['HW address']);
        $mask      = new StringLiteral($fields['Mask']);
        $device    = new StringLiteral($fields['Device']);

        return new static(
            $ip, $hwType, $flags, $hwAddress, $mask, $device
        );
    }

    /**
     * @param array $fields
     * @return boolean
     */
    static function isHeader($fields)
    {
        return $fields[0] === 'IP address';
    }

    /**
     * @return IPAddress
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param IPAddress $ipAddress
     *
     * @return ArpHost
     */
    public function setIpAddress(IPAddress $ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * @return Integer
     */
    public function getHardwareType()
    {
        return $this->hardwareType;
    }

    /**
     * @param Integer $hardwareType
     *
     * @return ArpHost
     */
    public function setHardwareType(Integer $hardwareType)
    {
        $this->hardwareType = $hardwareType;

        return $this;
    }

    /**
     * @return Integer
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param Integer $flags
     *
     * @return ArpHost
     */
    public function setFlags(Integer $flags)
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * @return MacAddress
     */
    public function getMacAddress()
    {
        return $this->macAddress;
    }

    /**
     * @param MacAddress $macAddress
     *
     * @return ArpHost
     */
    public function setMacAddress(MacAddress $macAddress)
    {
        $this->macAddress = $macAddress;

        return $this;
    }

    /**
     * @return StringLiteral
     */
    public function getMask()
    {
        return $this->mask;
    }

    /**
     * @param StringLiteral $mask
     *
     * @return ArpHost
     */
    public function setMask(StringLiteral $mask)
    {
        $this->mask = $mask;

        return $this;
    }

    /**
     * @return StringLiteral
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param StringLiteral $device
     *
     * @return ArpHost
     */
    public function setDevice(StringLiteral $device)
    {
        $this->device = $device;

        return $this;
    }


}