<?php

/*
 * This file is part of the AJGL packages
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\Csv\Reader;

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
        $row = fgetcsv($this->getHandler(), 0, $this->getDelimiter(), '"', '"');

        return ($row !== false) ? $row : null;
    }
}
