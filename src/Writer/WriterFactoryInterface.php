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

namespace Ajgl\Csv\Writer;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
interface WriterFactoryInterface
{
    public function createWriter(
        string $type,
        string $filePath,
        string $delimiter = WriterInterface::DELIMITER_DEFAULT,
        string $fileCharset = WriterInterface::CHARSET_DEFAULT,
        string $mode = 'w'
    ): WriterInterface;
}
