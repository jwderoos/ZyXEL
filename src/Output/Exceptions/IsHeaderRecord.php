<?php

namespace jwdr\ZyXEL\Output\Exceptions;

class IsHeaderRecord extends \Exception
{
    function __construct()
    {
        $this->message = "Header record";
    }
}