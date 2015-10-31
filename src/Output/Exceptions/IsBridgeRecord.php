<?php

namespace jwdr\ZyXEL\Output\Exceptions;

class IsBridgeRecord extends \Exception
{
    function __construct()
    {
        $this->message = "Bridge identification record";
    }
}