<?php

declare(strict_types=1);

/*
 * AJGL CSV Library
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
    protected $validModes = ['r+', 'w', 'w+', 'a', 'a+', 'x', 'x+', 'c', 'c+'];

    public function __construct(string $filePath, string $delimiter = WriterInterface::DELIMITER_DEFAULT, string $fileCharset = WriterInterface::CHARSET_DEFAULT, string $mode = 'w')
    {
        parent::__construct($filePath, $mode, $delimiter, $fileCharset);
    }

    public function writeRow(array $row, string $inputCharset = IoInterface::CHARSET_DEFAULT): self
    {
        if ($inputCharset !== $this->getFileCharset()) {
            $row = $this->convertRowCharset($row, $inputCharset, $this->getFileCharset());
        }
        $this->doWrite($this->getHandler(), $row, $this->getDelimiter());

        return $this;
    }

    public function writeRows(array $rows, $inputCharset = IoInterface::CHARSET_DEFAULT): self
    {
        foreach ($rows as $row) {
            $this->writeRow($row, $inputCharset);
        }

        return $this;
    }

    /**
     * @param resource $fileHandler
     * @param string   $delimiter
     */
    abstract protected function doWrite($fileHandler, array $row, $delimiter): void;
}
