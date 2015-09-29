<?php

/*
 * This file is part of the AJGL packages
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\Csv\Io;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
interface IoInterface
{
    /**
     * @var string
     */
    const CHARSET_DEFAULT = 'UTF-8';

    /**
     * @var string
     */
    const DELIMITER_DEFAULT = ',';

    /**
     * @return string
     */
    public function getFilePath();

    /**
     * @return string
     */
    public function getDelimiter();

    /**
     * @return string
     */
    public function getFileCharset();

    /**
     * @return \Ajgl\Csv\Charset\ConverterInterface
     */
    public function getConverter();
}
