<?php

declare(strict_types=1);

/*
 * AJGL CSV Library
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\Csv\Io;

use Ajgl\Csv\Charset\ConverterInterface;

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

    public function getFilePath(): string;

    public function getDelimiter(): string;

    public function getFileCharset(): string;

    public function getConverter(): ConverterInterface;
}
