<?php

namespace jwdr\ZyXEL\ValueObjects;

use ValueObjects\Exception\InvalidNativeArgumentException;
use ValueObjects\String\String;

class MacAddress extends String
{
    /**
     * Returns a new MacAddress
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_IP);

        if (!$this->isValid($value)) {
            throw new InvalidNativeArgumentException($value, ['string (valid mac address)']);
        }

        $this->value = $this->filter($filteredValue);
    }

    protected function isValid($value)
    {
        return (preg_match('/([a-fA-F0-9]{2}[:|\-]?){6}/', $value) == 1);
    }

    protected function filter($value, $separator = [':', '-'])
    {
        return strtoupper(str_replace($separator, '', $value));
    }

    protected function AddSeparator($value, $separator = ':')
    {
        return join($separator, str_split($value, 2));
    }

    function __toString()
    {
        return $this->AddSeparator($this->value);
    }
}