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

use Ajgl\Csv\Io\IoAbstract;
use Ajgl\Csv\Io\IoInterface;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
abstract class ReaderAbstract
    extends IoAbstract
    implements ReaderInterface
{
    /**
     * @var array
     */
    protected $validModes = array('r', 'r+', 'w+', 'a', 'a+', 'x', 'x+', 'c', 'c+');

    /**
     * @inheritdoc
     */
    public function readNextRow($outputCharset = IoInterface::CHARSET_DEFAULT)
    {

        $row = $this->doRead($this->getHandler(), $this->getDelimiter());

        if ($row !== null && $outputCharset != $this->getFileCharset()) {
            $row = $this->convertRowCharset($row, $this->getFileCharset(), $outputCharset);
        }

        return $row;
    }

    /**
     * @inheritdoc
     */
    public function readNextRows($inputCharset = IoInterface::CHARSET_DEFAULT, $limit = null)
    {
        $res = array();
        if ($limit === null) {
            while ($row = $this->readNextRow($inputCharset)) {
                array_push($res, $row);
            }
        } else {
            $limit = (integer) $limit;
            for ($i = 0; $i < $limit; $i++) {
                if ($row = $this->readNextRow($inputCharset)) {
                    array_push($res, $row);
                } else {
                    break;
                }
            }
        }

        return $res;
    }

    /**
     * @param  resource $fileHandler
     * @param  string   $delimiter
     * @return array
     */
    abstract protected function doRead($fileHandler, $delimiter);

}
