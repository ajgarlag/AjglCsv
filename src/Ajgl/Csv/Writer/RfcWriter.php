<?php
/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Writer
 */
namespace Ajgl\Csv\Writer;

/**
 * @category   Ajgl
 * @package    Ajgl\Csv
 * @subpackage Writer
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
