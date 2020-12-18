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

use Ajgl\Csv\Io\IoInterface;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
interface WriterInterface extends IoInterface
{
    public function writeRow(array $row, string $inputCharset = IoInterface::CHARSET_DEFAULT): self;

    public function writeRows(array $rows, string $inputCharset = IoInterface::CHARSET_DEFAULT): self;
}
