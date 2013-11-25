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
interface ReaderFactoryInterface
{
    /**
     * @param  string          $type
     * @param  string          $filePath
     * @param  string          $mode
     * @param  string          $delimiter
     * @param  string          $fileCharset
     * @return ReaderInterface
     */
    public function createReader(
        $type,
        $filePath,
        $mode,
        $delimiter = ReaderInterface::DELIMITER_DEFAULT,
        $fileCharset = ReaderInterface::CHARSET_DEFAULT
    );
}
