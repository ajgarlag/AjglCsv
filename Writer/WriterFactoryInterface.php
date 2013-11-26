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
interface WriterFactoryInterface
{
    /**
     * @param  string          $type
     * @param  string          $filePath
     * @param  string          $mode
     * @param  string          $delimiter
     * @param  string          $fileCharset
     * @return WriterInterface
     */
    public function createWriter(
        $type,
        $filePath,
        $mode,
        $delimiter = WriterInterface::DELIMITER_DEFAULT,
        $fileCharset = WriterInterface::CHARSET_DEFAULT
    );
}