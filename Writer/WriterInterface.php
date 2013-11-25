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

use Ajgl\Csv\Io\IoInterface;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
interface WriterInterface
    extends IoInterface
{

    /**
     * @param array $row
     * @param type  $inputCharset
     */
    public function writeRow(array $row, $inputCharset = IoInterface::CHARSET_DEFAULT);

    /**
     * @param array $row
     * @param type  $inputCharset
     */
    public function writeRows(array $rows, $inputCharset = IoInterface::CHARSET_DEFAULT);
}
