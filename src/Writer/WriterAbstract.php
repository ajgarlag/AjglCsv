<?php

/*
 * This file is part of the AJGL packages
 *
 * Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ajgl\Csv\Writer;

use Ajgl\Csv\Io\IoAbstract;
use Ajgl\Csv\Io\IoInterface;

/**
 * @author Antonio J. García Lagar <aj@garcialagar.es>
 */
abstract class WriterAbstract extends IoAbstract implements WriterInterface
{
    /**
     * @var array
     */
    protected $validModes = array('r+', 'w', 'w+', 'a', 'a+', 'x', 'x+', 'c', 'c+');

    /**
     * Class constructor.
     *
     * @param string $filePath
     * @param string $delimiter
     * @param string $fileCharset
     * @param string $mode
     */
    public function __construct($filePath, $delimiter = WriterInterface::DELIMITER_DEFAULT, $fileCharset = WriterInterface::CHARSET_DEFAULT, $mode = 'w')
    {
        parent::__construct($filePath, $mode, $delimiter, $fileCharset);
    }

    /**
     * {@inheritdoc}
     */
    public function writeRow(array $row, $inputCharset = IoInterface::CHARSET_DEFAULT)
    {
        if ($inputCharset !== $this->getFileCharset()) {
            $row = $this->convertRowCharset($row, $inputCharset, $this->getFileCharset());
        }
        $this->doWrite($this->getHandler(), $row, $this->getDelimiter());

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function writeRows(array $rows, $inputCharset = IoInterface::CHARSET_DEFAULT)
    {
        foreach ($rows as $row) {
            $this->writeRow($row, $inputCharset);
        }

        return $this;
    }

    /**
     * @param resource $fileHandler
     * @param array    $row
     * @param string   $delimiter
     */
    abstract protected function doWrite($fileHandler, array $row, $delimiter);
}
