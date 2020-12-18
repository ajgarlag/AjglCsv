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

namespace Ajgl\Csv\Charset;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
interface ConverterInterface
{
    public function convert(string $value, string $inputCharset, string $outputCharset): string;
}
