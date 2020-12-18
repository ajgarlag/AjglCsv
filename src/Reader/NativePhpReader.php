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

use function fgetcsv;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class NativePhpReader extends ReaderAbstract
{
    protected function doRead(): ?array
    {
        $row = fgetcsv($this->getHandler(), 0, $this->getDelimiter());

        return (false !== $row) ? $row : null;
    }
}
