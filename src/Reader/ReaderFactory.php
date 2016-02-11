<?php

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
class ReaderFactory implements ReaderFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createReader(
        $type,
        $filePath,
        $delimiter = ReaderInterface::DELIMITER_DEFAULT,
        $fileCharset = ReaderInterface::CHARSET_DEFAULT,
        $mode = 'r'
    ) {
        switch ($type) {
            case 'php':
                return new NativePhpReader($filePath, $delimiter, $fileCharset, $mode);
                break;
            case 'rfc':
                return new RfcReader($filePath, $delimiter, $fileCharset, $mode);
                break;
            default:
                throw new \InvalidArgumentException(
                    sprintf("Unsupported reader type '%s'", $type)
                );
                break;
        }
    }
}
