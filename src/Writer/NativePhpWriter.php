<?php

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
class NativePhpWriter extends WriterAbstract
{
    /**
     * {@inheritdoc}
     */
    protected function doWrite($fileHandler, array $row, $delimiter)
    {
        $res = @fputcsv($fileHandler, $row, $delimiter);
        if (false === $res) {
            throw new \RuntimeException('Cannot write to the given resource');
        }
    }
}
