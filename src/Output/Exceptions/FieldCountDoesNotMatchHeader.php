<?php

namespace jwdr\ZyXEL\Output\Exceptions;

class FieldCountDoesNotMatchHeader extends \Exception
{
    function __construct()
    {
        $this->message = "Bridge identification record";

    }
}