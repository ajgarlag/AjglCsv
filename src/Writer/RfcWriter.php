<?php

/*
 * AJGL CSV Library
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\Csv\Writer;

use Ajgl\Csv\Rfc\CsvRfcUtils;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class RfcWriter extends WriterAbstract
{
    /**
     * @var string
     */
    const EOL = "\r\n";

    /**
     * @category   Ajgl
     */
    protected function doWrite($fileHandler, array $row, $delimiter)
    {
        CsvRfcUtils::fPutCsv($fileHandler, $row, $delimiter, '"', '"', self::EOL);
    }

    /**
     * This code was borrowed from goodby/csv under MIT LICENSE.
     *
     * @author Hidehito Nozawa <suinyeze@gmail.com>
     *
     * @see    https://github.com/goodby/csv
     * @see    https://github.com/goodby/csv/blob/c6677d9c68323ef734a67a34f3e5feabcafd5b4e/src/Goodby/CSV/Export/Standard/CsvFileObject.php#L46
     *
     * @param array  $row
     * @param string $delimiter
     *
     * @return string
     */
    public static function arrayToString(array $row, $delimiter)
    {
        $fp = fopen('php://temp', 'w+');
        fputcsv($fp, $row, $delimiter);
        rewind($fp);
        $line = '';
        while (feof($fp) === false) {
            $line .= fgets($fp);
        }
        fclose($fp);

        return rtrim(str_replace('\"', '\""', $line), "\n");
    }
}
