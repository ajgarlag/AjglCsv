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
}
