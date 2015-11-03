<?php

namespace jwdr\ZyXEL\Output;

use jwdr\ZyXEL\Output\Exceptions\FieldCountDoesNotMatchHeader;
use jwdr\ZyXEL\Output\Exceptions\HeaderNotSet;
use jwdr\ZyXEL\Output\Exceptions\IsHeaderRecord;
abstract class AbstractResult implements ResultTypeInterface
{
    /**
     * @var array
     */
    private static $header = [];

    static public function prepareFields($rawData)
    {
        $cleanData = self::cleanup($rawData);
        $fields    = explode("  ", $cleanData);

        static::checkForHeader($fields);

        if (count($fields) !== count(static::getHeader())) {
            throw new FieldCountDoesNotMatchHeader(static::getHeader(), $fields);
        }

        $fields = array_combine(static::getHeader(), $fields);

        return $fields;
    }

    protected static function cleanup($record)
    {
        $record = preg_replace(['/^\s+/', '/\s\s+/'], ['', '  '], $record);

        return $record;
    }

    /**
     * @param array $fields
     * @throws IsHeaderRecord
     */
    protected static function checkForHeader($fields)
    {
        if (static::isHeader($fields)) {
            static::setHeader($fields);
            throw new IsHeaderRecord();
        }
    }

    /**
     * @return array
     * @throws HeaderNotSet
     */
    protected static function getHeader()
    {
        if (!self::headerIsSet()) {
            throw new HeaderNotSet('Header not set');
        }

        return self::$header[get_called_class()];
    }

    protected static function setHeader($fields)
    {
        self::$header[get_called_class()] = $fields;
    }

    protected static function headerIsSet()
    {
        return isset(self::$header[get_called_class()]);
    }

    protected static function unsetHeader()
    {
        self::$header = [];
    }
}