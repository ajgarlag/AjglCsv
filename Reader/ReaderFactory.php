<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Csv\Reader;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class ReaderFactory
    implements ReaderFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createReader(
        $type,
        $filePath,
        $mode,
        $delimiter = ReaderInterface::DELIMITER_DEFAULT,
        $fileCharset = ReaderInterface::CHARSET_DEFAULT
    )
    {
        switch ($type) {
            case 'php':
                return new NativePhpReader($filePath, $mode, $delimiter, $fileCharset);
                break;
            case 'rfc':
                return new RfcReader($filePath, $mode, $delimiter, $fileCharset);
                break;
            default:
                throw new \InvalidArgumentException(
                    sprintf("Unsupported reader type '%s'", $type)
                );
                break;
        }
    }
}
