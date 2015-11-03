<?php

namespace jwdr\ZyXEL\Output\Exceptions;

class FieldCountDoesNotMatchHeader extends \Exception
{
    public function __construct($header, $fields)
    {
        $this->message = sprintf(
            "Header and field counts do not match: %d - %d",
            count($header),
            count($fields)
        );
    }
}