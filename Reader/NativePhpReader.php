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
class NativePhpReader
    extends ReaderAbstract
{
    /**
     * @inheritdoc
     */
    protected function doRead($fileHandler, $delimiter)
    {
        $row = fgetcsv($fileHandler, 0, $delimiter);

        return ($row !== false)?$row:null;
    }
}
