<?php

namespace jwdr\ZyXEL;

use ValueObjects\String\String as ValueString;
use ValueObjects\Web\IPAddress;
use ValueObjects\Web\PortNumber;
class Config
{
    /**
     * @var IPAddress
     */
    private $ipAddress;
    /**
     * @var PortNumber
     */
    private $portNumber;
    /**
     * @var ValueString
     */
    private $userName;
    /**
     * @var ValueString
     */
    private $passWord;

    function __construct(IPAddress $ipAddress, PortNumber $portNumber, ValueString $userName, ValueString $passWord)
    {
        $this->ipAddress = $ipAddress;
        $this->portNumber = $portNumber;
        $this->userName = $userName;
        $this->passWord = $passWord;
    }

    /**
     * @return IPAddress
     */
    public function getIpAddress()
    {
        return $this->ipAddress->toNative();
    }

    /**
     * @return PortNumber
     */
    public function getPortNumber()
    {
        return $this->portNumber->toNative();
    }

    /**
     * @return ValueString
     */
    public function getUserName()
    {
        return $this->userName->toNative();
    }

    /**
     * @return ValueString
     */
    public function getPassWord()
    {
        return $this->passWord->toNative();
    }


}