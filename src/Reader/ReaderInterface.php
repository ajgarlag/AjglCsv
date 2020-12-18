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

use Ajgl\Csv\Io\IoInterface;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
interface ReaderInterface extends IoInterface
{
    public function readNextRow(string $inputCharset = IoInterface::CHARSET_DEFAULT): ?array;

    public function readNextRows(string $inputCharset = IoInterface::CHARSET_DEFAULT, $limit = null): array;
}
