<?php
/**
 * This file is part of the AJ General Libraries
 *
 * Copyright (C) 2010-2013 Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ajgl\Csv\Writer;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
class WriterFactory
    implements WriterFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createWriter(
        $type,
        $filePath,
        $mode,
        $delimiter = WriterInterface::DELIMITER_DEFAULT,
        $fileCharset = WriterInterface::CHARSET_DEFAULT
    )
    {
        switch ($type) {
            case 'php':
                return new NativePhpWriter($filePath, $mode, $delimiter, $fileCharset);
                break;
            case 'rfc':
                return new RfcWriter($filePath, $mode, $delimiter, $fileCharset);
                break;
            default:
                throw new \InvalidArgumentException(
                    sprintf("Unsupported writer type '%s'", $type)
                );
                break;
        }
    }
}
