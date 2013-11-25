<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Csv\Writer;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class RfcWriter
    extends WriterAbstract
{
    /**
     * @var string
     */
    const EOL = "\r\n";

    /**
     * @category   Ajgl
     * @package    Ajgl\Csv
     * @subpackage Reader
     */
    protected function doWrite($fileHandler, array $row, $delimiter)
    {
        $row = $this->arrayToString($row, $delimiter);
        fwrite($fileHandler, $row . static::EOL);
    }

    /**
     * @param  array  $row
     * @param  string $delimiter
     * @return string
     */
    public static function arrayToString(array $row, $delimiter)
    {
        $callback = static::getEscaperCallback($delimiter);
        $row = array_map($callback, $row);

        return implode($delimiter, $row);
    }

    /**
     * @param  string   $delimiter
     * @return callback
     */
    protected static function getEscaperCallback($delimiter)
    {
        return function ($string) use ($delimiter) {
            $string = str_replace('"', '""', $string);
            if (
                strpos($string, '"')!== false
                ||
                strpos($string, $delimiter) !== false
                ||
                strpos($string, "\r") !== false
                ||
                strpos($string, "\n") !== false
                ) {
                $string = '"' . $string . '"';
            }

            return $string;
        };
    }

}
