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

namespace Ajgl\Csv\Reader;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
interface ReaderFactoryInterface
{
    public function createReader(
        string $type,
        string $filePath,
        string $delimiter = ReaderInterface::DELIMITER_DEFAULT,
        string $fileCharset = ReaderInterface::CHARSET_DEFAULT,
        string $mode = 'r'
    ): ReaderInterface;
}
