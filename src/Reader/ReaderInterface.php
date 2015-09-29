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

use Ajgl\Csv\Io\IoInterface;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
interface ReaderInterface extends IoInterface
{
    /**
     * @param string $inputCharset
     *
     * @return array | null
     */
    public function readNextRow($inputCharset = IoInterface::CHARSET_DEFAULT_INPUT);

    /**
     * @param string $inputCharset
     * @param int    $limit
     *
     * @return array
     */
    public function readNextRows($inputCharset = IoInterface::CHARSET_DEFAULT_INPUT, $limit = null);
}
