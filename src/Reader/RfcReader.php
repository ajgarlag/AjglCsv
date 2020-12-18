<?php

/*
 * AJGL CSV Library
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\Csv\Reader;

use Ajgl\Csv\Rfc\CsvRfcUtils;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class RfcReader extends ReaderAbstract
{
    /**
     * {@inheritdoc}
     */
    protected function doRead()
    {
        $row = CsvRfcUtils::fGetCsv($this->getHandler(), 0, $this->getDelimiter());

        return (false !== $row) ? $row : null;
    }
}
