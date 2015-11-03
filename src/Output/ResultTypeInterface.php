<?php

namespace jwdr\ZyXEL\Output;

interface ResultTypeInterface
{
    static public function fromRawData($rawData);

    /**
     * @param array $fields
     * @return boolean
     */
    static function isHeader($fields);
}