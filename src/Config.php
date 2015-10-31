<?php

namespace jwdr\ZyXEL;

use ValueObjects\StringLiteral\StringLiteral;
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
     * @var StringLiteral
     */
    private $userName;
    /**
     * @var StringLiteral
     */
    private $passWord;

    function __construct(IPAddress $ipAddress, PortNumber $portNumber, StringLiteral $userName, StringLiteral $passWord)
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
     * @return StringLiteral
     */
    public function getUserName()
    {
        return $this->userName->toNative();
    }

    /**
     * @return StringLiteral
     */
    public function getPassWord()
    {
        return $this->passWord->toNative();
    }


}