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
class WriterFactory implements WriterFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createWriter(
        $type,
        $filePath,
        $delimiter = WriterInterface::DELIMITER_DEFAULT,
        $fileCharset = WriterInterface::CHARSET_DEFAULT,
        $mode = 'w'
    ) {
        switch ($type) {
            case 'php':
                return new NativePhpWriter($filePath, $delimiter, $fileCharset, $mode);
                break;
            case 'rfc':
                return new RfcWriter($filePath, $delimiter, $fileCharset, $mode);
                break;
            default:
                throw new \InvalidArgumentException(sprintf("Unsupported writer type '%s'", $type));
                break;
        }
    }
}
