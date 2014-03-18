<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2014 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Csv\Reader;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class RfcReader
    extends ReaderAbstract
{
    /**
     * @var string
     */
    const EOL = "\r\n";

    /**
     * @inheritdoc
     */
    protected function doRead($fileHandler, $delimiter)
    {
        $row = fgets($fileHandler);
        $pattern = '/^("(?:[^"]|"")*"|[^'. $delimiter . '"]*)(' . $delimiter . '("(?:[^"]|"")*"|[^'
                . $delimiter . '"]*))*(?:' . static::EOL . '|\z)/';
        if ($row !== false) {
            while (!preg_match($pattern, $row, $match)) {
                $nextLine = fgets($fileHandler);
                if ($nextLine === false) {
                    throw new \RuntimeException("Premature EOF");
                }
                $row .= $nextLine;
            }

            return $this->stringToArray($row, $delimiter);
        }

    }

    /**
     * @param  string $string
     * @param  string $delimiter
     * @return array
     */
    public static function stringToArray($string, $delimiter)
    {
        $values = array();
        $matches = array();
        $pattern = '/(?<=' . $delimiter . '|\A)("(?:[^"]|"")*"|[^' . $delimiter . '"]*)/s';
        if (substr($string, -2) == static::EOL) {
            $string = substr($string, 0, -2);
        }
        preg_match_all($pattern, $string, $matches);
        foreach ($matches[1] as $value) {
            $value = str_replace('""', '"', $value);
            if (strpos($value, '"') === 0) {
                $value = substr($value, 1, -1);
            }
            array_push($values, $value);
        }

        return $values;
    }
}
